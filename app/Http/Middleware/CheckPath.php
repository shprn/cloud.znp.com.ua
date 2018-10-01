<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Folder;

class CheckPath
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

        $disk = $request->route("disk");
        $path = $request->route("path");

        if($path) {
            if (!Storage::disk($disk)->exists($path))
                abort(404);

            //if (Auth::guest() || Auth::user()->cant('read', Folder::current()))
            //    abort(403);
        }

        return $next($request);
    }
}
