<?php

namespace App\Http\Middleware;

use Closure;

class Moderator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        $abort = true;

        if($user != null)
            foreach ($user->roles as $role)
                if($role->role === 'admin' || $role->role === 'moderator')
                    $abort = false;

        if($abort) return abort(404);

        return $next($request);
    }
}
