<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
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
    // If user is not logged in...
     if (!Auth::check()) {
          return $next($request);
      }

      $user = Auth::guard()->user();

      $now = Carbon::now();

      $last_seen = Carbon::parse($user->last_seen_at);

      $absence = $now->diffInMinutes($last_seen);

      dump(config('session.lifetime'));

    // If user has been inactivity longer than the allowed inactivity period
      if ($absence > config('session.lifetime')) {
            dd("Absece de ".$absence);

          Auth::guard()->logout();
          $request->session()->invalidate();

          return $next($request);
      }

      $user->last_seen_at = $now->format('Y-m-d H:i:s');
      $user->save();

      return $next($request);
  }
}