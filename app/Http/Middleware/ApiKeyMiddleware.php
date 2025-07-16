<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next, ?string $permission = null): Response
    {
        $apiKey = $request->header('X-API-Key') ?? $request->bearerToken();

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key is required. Please provide X-API-Key header or Bearer token.'
            ], 401);
        }

        $key = ApiKey::where('key', $apiKey)
            ->active()
            ->with('user')
            ->first();

        if (!$key) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired API key.'
            ], 401);
        }

        if (!$key->user->isApiAuthorized()) {
            return response()->json([
                'success' => false,
                'message' => 'API access has been revoked for this account.'
            ], 403);
        }

        if ($key->user->isFrozen()) {
            return response()->json([
                'success' => false,
                'message' => 'Account is frozen. Please contact support.'
            ], 403);
        }

        if ($permission && !$key->hasPermission($permission)) {
            return response()->json([
                'success' => false,
                'message' => "Insufficient permissions. Required: {$permission}"
            ], 403);
        }

        // Update last used timestamp
        $key->updateLastUsed();

        // Set the authenticated user
        $request->setUserResolver(function () use ($key) {
            return $key->user;
        });

        return $next($request);
    }
}
