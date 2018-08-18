<?php

namespace App\Http\Middleware;

use Closure;

class CheckDiskProject
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
        $disks = config("filesystems.disks");
        $disk = $request->route("disk");

        if (!isset($disks[$disk]))
            return redirect()->route('disk_default');

        return $next($request);
    }
}
