<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifyCustomToken
{
    protected $customToken = 'qwertyuiopblog'; // don't play with token 
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('x-api-token');
        if (!$token) {
            return response()->json(['status'=>401,'message' => 'token is required.'], 200);
        }

        if ($token != $this->customToken) {
            return response()->json(['status'=>401,'message' => 'invalid token.'], 200);
        }

        return $next($request);
    }
}
