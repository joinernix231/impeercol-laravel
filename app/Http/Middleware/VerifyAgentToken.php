<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAgentToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $configuredToken = config('services.agent.api_token');

        if (! $configuredToken) {
            return response()->json([
                'success' => false,
                'message' => 'Agent API is not configured.',
            ], 503);
        }

        $providedToken = $request->header('X-Agent-Token') ?: $request->query('token');

        if (! is_string($providedToken) || ! hash_equals($configuredToken, $providedToken)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid agent token.',
            ], 401);
        }

        return $next($request);
    }
}
