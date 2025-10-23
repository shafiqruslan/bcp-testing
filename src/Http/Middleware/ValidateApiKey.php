<?php

namespace Shafiqruslan\BcpTesting\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get API key from request header
        $apiKey = $request->header('X-API-Key') ?? $request->bearerToken();

        // If no API key provided
        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'API key is required. Provide it via X-API-Key header or Authorization: Bearer token.',
            ], 401);
        }

        // Get allowed API key from config
        $allowedKey = env('BCP_TESTING_API_KEY');

        // Validate the API key
        if ($allowedKey !== $apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or unauthorized API key.',
            ], 403);
        }

        return $next($request);
    }
}
