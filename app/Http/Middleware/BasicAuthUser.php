<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        if (!$header || !str_starts_with($header, 'Basic ')) {
            return response()->json(['message' => 'Missing or invalid Authorization header'], 401);
        }

        $encoded = substr($header, 6);
        $decoded = base64_decode($encoded);
        [$email, $password] = explode(':', $decoded, 2);

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (!in_array($user->role, ['user', 'admin', 'super_admin'])) {
            return response()->json(['message' => 'Access denied.'], 403);
        }

        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
