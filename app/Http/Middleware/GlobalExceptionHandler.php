<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class GlobalExceptionHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Exception $e) {
            // Handle the exception and return a JSON response
            return $this->handleException($e);
        }
    }

    protected function handleException(Exception $e)
    {
        // You can customize the error response format as needed
        $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

        return new JsonResponse([
            'success' => false,
            'message' => 'An error occurred',
            'error' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ],
        ], $statusCode);
    }
}
