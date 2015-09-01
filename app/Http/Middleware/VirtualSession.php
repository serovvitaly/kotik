<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 31.08.15
 * Time: 22:10
 */

namespace App\Http\Middleware;


use Closure;

class VirtualSession
{
    const SESSION_VAR_NAME = 'smag_virtual_session';

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return
     */
    public function handle($request, Closure $next)
    {
        $virtual_user = \App\Helpers\VirtualUserHelper::user();

        $response = $next($request);

        if ( ! $virtual_user ) {

            $virtual_user = \App\Models\VirtualUser::create([
                'last_ip' => $request->ip()
            ]);

            $virtual_session = cookie(self::SESSION_VAR_NAME, $virtual_user->id);

            $response->withCookie($virtual_session);
        }

        return $response;
    }
}