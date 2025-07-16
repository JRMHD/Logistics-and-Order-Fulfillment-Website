<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index(Request $request)
    {
        $query = ApiKey::with('user')
            ->when($request->search, function ($q, $search) {
                return $q->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhere('name', 'like', "%{$search}%");
            })
            ->when($request->user_id, function ($q, $userId) {
                return $q->where('user_id', $userId);
            })
            ->when($request->is_active !== null, function ($q) use ($request) {
                return $q->where('is_active', $request->is_active);
            })
            ->when($request->expired, function ($q) {
                return $q->where('expires_at', '<', now());
            });

        $apiKeys = $query->orderBy('created_at', 'desc')->paginate(20);
        $users = User::where('api_authorized', true)->get();

        return view('admin.api-keys.index', compact('apiKeys', 'users'));
    }

    public function show(ApiKey $apiKey)
    {
        $apiKey->load('user');

        return view('admin.api-keys.show', compact('apiKey'));
    }

    public function destroy(ApiKey $apiKey)
    {
        $companyName = $apiKey->user->company_name;
        $keyName = $apiKey->name;

        $apiKey->delete();

        return redirect()->route('admin.api-keys.index')
            ->with('success', "API key '{$keyName}' for {$companyName} deleted successfully.");
    }

    public function toggle(ApiKey $apiKey)
    {
        $apiKey->update([
            'is_active' => !$apiKey->is_active,
        ]);

        $status = $apiKey->is_active ? 'activated' : 'deactivated';
        $companyName = $apiKey->user->company_name;

        return redirect()->route('admin.api-keys.index')
            ->with('success', "API key for {$companyName} {$status} successfully.");
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'api_key_ids' => 'required|array',
            'api_key_ids.*' => 'exists:api_keys,id',
            'action' => 'required|in:activate,deactivate,delete',
        ]);

        $apiKeys = ApiKey::whereIn('id', $request->api_key_ids)->get();
        $count = $apiKeys->count();

        switch ($request->action) {
            case 'activate':
                $apiKeys->each(function ($apiKey) {
                    $apiKey->update(['is_active' => true]);
                });
                $message = "{$count} API keys activated successfully.";
                break;

            case 'deactivate':
                $apiKeys->each(function ($apiKey) {
                    $apiKey->update(['is_active' => false]);
                });
                $message = "{$count} API keys deactivated successfully.";
                break;

            case 'delete':
                $apiKeys->each(function ($apiKey) {
                    $apiKey->delete();
                });
                $message = "{$count} API keys deleted successfully.";
                break;
        }

        return redirect()->route('admin.api-keys.index')
            ->with('success', $message);
    }

    public function usage(ApiKey $apiKey)
    {
        $apiKey->load(['user']);

        // Get usage statistics
        $totalOrders = $apiKey->user->orders()->count();
        $recentOrders = $apiKey->user->orders()
            ->with('statusHistory')
            ->latest()
            ->limit(10)
            ->get();

        $ordersByStatus = $apiKey->user->orders()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        $ordersThisMonth = $apiKey->user->orders()
            ->whereMonth('created_at', now()->month)
            ->count();

        return view('admin.api-keys.usage', compact(
            'apiKey',
            'totalOrders',
            'recentOrders',
            'ordersByStatus',
            'ordersThisMonth'
        ));
    }
}
