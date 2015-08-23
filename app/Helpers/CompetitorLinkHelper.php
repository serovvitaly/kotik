<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 23.08.15
 * Time: 23:03
 */

namespace App\Helpers;


class CompetitorLinkHelper
{

    public static function do_url($url)
    {
        $out = new \stdClass();

        $out->url = $url;
        $out->price = '';
        $out->image = '';

        $url_segs = parse_url($url);

        if (!array_key_exists('host', $url_segs) or empty($url_segs['host'])) {
            return $out;
        }

        $do_method_name = 'do_' . str_replace('.', '_', $url_segs['host']);

        if ( !method_exists(__CLASS__, $do_method_name) ) {
            return $out;
        }

        $do_result = self::$do_method_name($url);

        $out->price = $do_result->price;
        $out->image = $do_result->image;

        return $out;
    }

    public static function do_www_zdravzona_ru($url)
    {
        $out = new \stdClass();

        $out->price = '';
        $out->image = '';

        $content = file_get_contents($url);

        preg_match('/<div class="m-pc-p-price">\s+([\d\.\,]+)\s*<i/s', $content, $price_matches);
        if (!empty($price_matches)) {
            $price = $price_matches[1];
            $price = str_replace(',', '.', $price);
            $out->price = $price;
        }

        preg_match('/<a class="fancy" href="([a-zA-Z0-9\/\.-_]+)">/s', $content, $image_matches);
        if (!empty($image_matches)) {
            $image = $image_matches[1];
            $out->image = $image;
        }

        return $out;
    }

    public static function do_www_utkonos_ru($url)
    {
        $out = new \stdClass();

        $out->price = '';
        $out->image = '';

        $content = file_get_contents($url);

        preg_match('/<span class="rub">([\d\.\,]+)<\/span>/', $content, $price_matches);
        if (!empty($price_matches)) {
            $price = $price_matches[1];
            $price = str_replace(',', '.', $price);
            $out->price = $price;
        }

        preg_match('/class="goods_pic active  module_zoom_pic" data-pic-high="([a-zA-Z0-9\/\.\?-_]+)">/s', $content, $image_matches);
        if (!empty($image_matches)) {
            $image = $image_matches[1];
            $out->image = $image;
        }

        return $out;
    }

}