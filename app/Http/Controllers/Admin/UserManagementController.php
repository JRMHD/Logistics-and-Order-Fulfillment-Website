<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('company_name', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }

        // Filter by role
        if ($request->filled('role') && $request->get('role') !== 'all') {
            $query->where('role', $request->get('role'));
        }

        // Filter by status
        if ($request->filled('status') && $request->get('status') !== 'all') {
            if ($request->get('status') === 'active') {
                $query->where('is_frozen', false);
            } elseif ($request->get('status') === 'frozen') {
                $query->where('is_frozen', true);
            }
        }

        // Filter by API authorization
        if ($request->filled('api_status') && $request->get('api_status') !== 'all') {
            if ($request->get('api_status') === 'authorized') {
                $query->where('api_authorized', true);
            } elseif ($request->get('api_status') === 'unauthorized') {
                $query->where('api_authorized', false);
            }
        }

        // Order by admin first, then latest
        $users = $query->orderByRaw("
            CASE 
                WHEN role = 'admin' THEN 1
                WHEN role = 'manager' THEN 2
                WHEN role = 'user' THEN 3
                ELSE 4
            END
        ")
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        // Get statistics
        $totalUsers = User::count();

        // Count online users using Cache - only check users that have been active
        $onlineUsersCount = 0;
        $userIds = User::pluck('id');
        foreach ($userIds as $userId) {
            if (Cache::has('user-is-online-' . $userId)) {
                $onlineUsersCount++;
            }
        }

        $offlineUsers = $totalUsers - $onlineUsersCount;

        return view('admin.users.index', compact('users', 'totalUsers', 'onlineUsersCount', 'offlineUsers'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'role' => ['required', 'in:user,manager,admin'],
            'api_authorized' => ['boolean'],
        ]);

        // Generate a temporary password
        $temporaryPassword = Str::random(12);

        $companyLogoPath = null;
        if ($request->hasFile('company_logo')) {
            $companyLogoPath = $request->file('company_logo')->store('company_logos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($temporaryPassword),
            'phone_number' => $request->phone_number,
            'company_name' => $request->company_name,
            'company_logo' => $companyLogoPath,
            'role' => $request->role,
            'is_frozen' => false,
            'api_authorized' => $request->boolean('api_authorized', false),
        ]);

        // Send welcome email with temporary password
        try {
            Mail::to($user->email)->send(new WelcomeUser($user, $temporaryPassword));
        } catch (\Exception $e) {
            // Log the error but don't fail the user creation
            Log::error('Failed to send welcome email: ' . $e->getMessage());

            return redirect()->route('admin.users.index')
                ->with('warning', 'User created successfully, but welcome email could not be sent. Temporary password: ' . $temporaryPassword);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully and welcome email sent.');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'role' => ['required', 'in:user,manager,admin'],
            'api_authorized' => ['boolean'],
        ]);

        $companyLogoPath = $user->company_logo;
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($user->company_logo) {
                Storage::disk('public')->delete($user->company_logo);
            }
            $companyLogoPath = $request->file('company_logo')->store('company_logos', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'company_name' => $request->company_name,
            'company_logo' => $companyLogoPath,
            'role' => $request->role,
            'api_authorized' => $request->boolean('api_authorized', false),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy(User $user)
    {
        // Prevent deletion of admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Admin users cannot be deleted.');
        }

        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete company logo if exists
        if ($user->company_logo) {
            Storage::disk('public')->delete($user->company_logo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Freeze/Unfreeze a user
     */
    public function toggleFreeze(User $user)
    {
        // Prevent freezing admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Admin users cannot be frozen.');
        }

        // Prevent self-freezing
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot freeze your own account.');
        }

        $user->update([
            'is_frozen' => !$user->is_frozen
        ]);

        $status = $user->is_frozen ? 'frozen' : 'unfrozen';
        return redirect()->route('admin.users.index')
            ->with('success', "User has been {$status} successfully.");
    }

    /**
     * Update user's password
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Toggle API authorization for user
     */
    public function toggleApiAuthorization(User $user)
    {
        $user->update([
            'api_authorized' => !$user->api_authorized
        ]);

        $status = $user->api_authorized ? 'authorized' : 'unauthorized';
        return redirect()->route('admin.users.show', $user)
            ->with('success', "User has been {$status} for API access.");
    }
}
