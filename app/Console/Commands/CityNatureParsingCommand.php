<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CityNatureParsingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citynature:parsing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function parse($file_name)
    {
        $file_content = file_get_contents('/var/www/kotik/storage/app/citynature.ru/'.$file_name);

        preg_match_all('@\<a style = "" href="([-a-z\./_0-9]+)" rel="nofollow"\>(.+)\<\/a\>@i', $file_content, $links);

        $links_arr = [];

        foreach ($links[1] as $link) {

            $links_arr[] = $link;

        }

        return $links_arr;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files_list = scandir('/var/www/kotik/storage/app/citynature.ru/');

        $links_arr = [];

        foreach ($files_list as $file_name) {

            if ( in_array($file_name, ['.', '..']) ) {
                continue;
            }

            $file_content = file_get_contents('/var/www/kotik/storage/app/citynature.ru/'.$file_name);

            preg_match('@<li class="active"><span>(.+?)</span></li>@is', $file_content, $cats);

            $cat = '';
            if (count($cats) == 2) {
                $cat = $cats[1];
            }

            foreach ($this->parse($file_name) as $link) {

                $product_model = \App\Models\Product::where('source_url', '=', $link)->first();

                if (!$product_model) {
                    continue;
                }

                $product_model->base_country_name = trim($cat);
                $product_model->save();

            }

            //$links_arr = array_merge($links_arr, $this->parse($file_name));
        }

        return;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true
        ]);

        foreach ($links_arr as $link) {

            $file_name = '/var/www/kotik/storage/app/citynature_pages/' . md5($link) . '.html';

            if (file_exists($file_name)) {
                continue;
            }

            $url = 'http://www.citynature.ru' . $link;

            curl_setopt($curl, CURLOPT_URL, $url);

            $res = curl_exec($curl);

            file_put_contents($file_name, $res);

            echo ".";
            sleep(rand(1, 3));
        }

    }
}
