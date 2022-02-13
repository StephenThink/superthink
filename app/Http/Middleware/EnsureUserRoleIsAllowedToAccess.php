<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{

    // info
    // current routes

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            //code...
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();

            if (in_array($currentRouteName, $this->userAccessRole()[$userRole]))
            {
                return $next($request);
            } else {
                abort(403, 'Unauthorized Action.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            abort(403, 'Unauthorized Action.');
        }

    }

    /**
     * The list of accessible resource for a specific user.
     * We will store this in the database later.
     *
     * @return void
     */
    private function userAccessRole()
    {
        return [
            'user' => [
                'dashboard',
            ],
            'admin' => [
                'dashboard',
                'pages',
                'navigation-menus',
                'users',
                'user-permissions'
            ],
        ];
    }
}
