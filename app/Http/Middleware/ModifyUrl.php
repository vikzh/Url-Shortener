<?php

namespace App\Http\Middleware;

use Closure;

class ModifyUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->has('url-to-short')) {
            return $next($request);
        }
        $validator = \Validator::make($request->only('url-to-short'), [
            'url-to-short' => 'url'
        ]);
        if ($validator->fails()) {
            $request->merge([
                'url-to-short' => 'http://' . $request['url-to-short']
            ]);
        }

        return $next($request);
    }
}
