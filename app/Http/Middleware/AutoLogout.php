<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AutoLogout
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = Auth::user();
            $user->last_activity = Carbon::now();
            $user->save();
            $lastActivity = Carbon::parse($user->last_activity);
            if (Carbon::now()->diffInMinutes($lastActivity) > 10) {
                Auth::logout();
                return redirect('/login')->with('logout', true);
            }
        }

        return $next($request);
    }

}
