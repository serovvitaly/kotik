<?php

namespace App\Helpers;

class CommonHelper {
    public static function getCurrentUser()
    {
        return \Auth::user();
    }
}
