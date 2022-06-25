<?php
namespace App\Http\Middleware;

use Cache;
use Closure;
use Carbon\Carbon;
use App\Models\User;
use Auth;
class ActivityByUser
{
    public function handle($request, Closure $next)
    {
        //dump(Auth::user(), $request);
        if (Auth::user()) {

            $expiresAt = Carbon::now()->addMinutes(1); // keep online for 1 min


            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            // last seen
            User::where('id', Auth::user()->id)->update(['last_seen_at' => (new \DateTime())->format("Y-m-d H:i:s")]);
        }


        return $next($request);
    }
}