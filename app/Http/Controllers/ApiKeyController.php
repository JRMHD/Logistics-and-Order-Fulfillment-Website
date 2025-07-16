<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // if (!$user->api_authorized) {
        //     return redirect()->route('dashboard')->with('error', 'You are not authorized to access API keys. Please contact admin.');
        // }

        $apiKeys = ApiKey::where('user_id', $user->id)->latest()->get();

        return view('api-keys.index', compact('apiKeys'));
    }

    public function create()
    {
        $user = Auth::user();

        // if (!$user->api_authorized) {
        //     return redirect()->route('dashboard')->with('error', 'You are not authorized to create API keys.');
        // }

        return view('api-keys.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // if (!$user->api_authorized) {
        //     return redirect()->route('dashboard')->with('error', 'You are not authorized to create API keys.');
        // }

        $request->validate([
            'name' => 'required|string|max:255',
            'expires_at' => 'nullable|date|after:now',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|in:orders.read,orders.write,orders.track',
        ]);

        $apiKey = ApiKey::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'key' => ApiKey::generateKey(),
            'permissions' => $request->permissions ?? ['orders.read', 'orders.write', 'orders.track'],
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('api-keys.show', $apiKey)
            ->with('success', 'API key created successfully! Please copy the key now as it will not be shown again.');
    }

    public function show(ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        return view('api-keys.show', compact('apiKey'));
    }

    public function edit(ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        return view('api-keys.edit', compact('apiKey'));
    }

    public function update(Request $request, ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|in:orders.read,orders.write,orders.track',
        ]);

        $apiKey->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
            'expires_at' => $request->expires_at,
            'permissions' => $request->permissions ?? ['orders.read', 'orders.write', 'orders.track'],
        ]);

        return redirect()->route('api-keys.index')
            ->with('success', 'API key updated successfully.');
    }

    public function destroy(ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        $apiKey->delete();

        return redirect()->route('api-keys.index')
            ->with('success', 'API key deleted successfully.');
    }

    public function regenerate(ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        $apiKey->update([
            'key' => ApiKey::generateKey(),
        ]);

        return redirect()->route('api-keys.show', $apiKey)
            ->with('success', 'API key regenerated successfully! Please copy the new key now.');
    }

    public function toggle(ApiKey $apiKey)
    {
        // if ($apiKey->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access to API key.');
        // }

        $apiKey->update([
            'is_active' => !$apiKey->is_active,
        ]);

        $status = $apiKey->is_active ? 'activated' : 'deactivated';

        return redirect()->route('api-keys.index')
            ->with('success', "API key {$status} successfully.");
    }
}
