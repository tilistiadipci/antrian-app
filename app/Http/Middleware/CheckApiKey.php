<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiKey
{
    /**
     * Validate the API key sent through the x-api-key header.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $configuredKey = (string) config('api.key');
        $providedKey = (string) $request->header('x-api-key');

        if ($configuredKey === '' || $providedKey === '' || ! hash_equals($configuredKey, $providedKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. API key tidak valid.',
            ], 401);
        }

        return $next($request);
    }
}
