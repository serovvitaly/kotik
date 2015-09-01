<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 01.09.15
 * Time: 22:01
 */

namespace App\Helpers;


class VirtualUserHelper
{
    const SESSION_VAR_NAME = 'smag_virtual_session';

    public static function user()
    {
        $virtual_user_id = \Request::cookie(self::SESSION_VAR_NAME);

        return \App\Models\VirtualUser::find($virtual_user_id);
    }
}