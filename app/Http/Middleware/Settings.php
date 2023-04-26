<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin\Setting;

class Settings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Setting::all();
        $data[] = null;

        foreach($settings as $value)
        {
            $data["{$value->key}"] =  $value->value;
        }

        config(['settings' => $data]);

        return $next($request);
    }
}
