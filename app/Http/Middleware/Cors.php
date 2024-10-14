<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request); // Get the response object

        // Check if $response is an instance of the Response class
        if ($response instanceof Response) {
            // Add CORS headers to the response
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'X-XSRF-TOKEN, Authorization, Content-Type, Origin, Content-Disposition');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        return $response; // Return the modified response
    }
}
