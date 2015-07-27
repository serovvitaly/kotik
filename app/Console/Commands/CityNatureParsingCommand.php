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

    public function parse($file_name)
    {
        $file_content = file_get_contents('/var/www/kotik/storage/app/citynature.ru/'.$file_name);

        preg_match_all('@\<a style = "" href="([-a-z\./_0-9]+)" rel="nofollow"\>(.+)\<\/a\>@i', $file_content, $links);
        preg_match_all('@\<span style = "color\:\#363636\;font-weight\:bolder\;"\>([^<]+)\<\/span\>@i', $file_content, $articles);
        //preg_match_all('@Мин\. партия\: от \<span\>(\d*)\<\/span\>@i', $file_content, $parts);

        if (count($links[1]) != count($links[2]) or count($links[1]) != count($articles[1])) {

            $count_str = '' . count($links[1]) . ':' . count($links[2]) . ':' . count($articles[1]) . '--';

            echo "count fail - ", $count_str, $file_name, "\n";

            print_r($articles[1]);

            return;
        }

        $links = $links[1];
        //$titles = $links[2];
        $articles = $articles[1];

        foreach ($links as $key => $link) {
            //$title = $titles[$key];
            $article = $articles[$key];

            $products_by_article = \App\Models\Product::where('article', '=', $article);

            if ($products_by_article->count() != 1) {
                continue;
            }

            $product = $products_by_article->first();

            $product->source_url = 'http://www.citynature.ru' . $link;

            $product->save();
        }

        //print_r($links);
        //print_r($articles[1]);
        //print_r($parts[1]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files_list = scandir('/var/www/kotik/storage/app/citynature.ru/');

        foreach ($files_list as $file_name) {

            if ( in_array($file_name, ['.', '..']) ) {
                continue;
            }

            $this->parse($file_name);
        }



        return;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true
        ]);

        /**
         * cosmetic?start=7040
         * parfyumeriya?start=280
         * podarki?start=200
         * mama-i-malysh?start=810
         * catalog/mama-i-malysh?start=220
         * bytovaya-khimiya?start=360
         */

        $category = 'catalog/mama-i-malysh';

        for ($start = 0; $start <= 220; $start += 10) {
            $url = 'http://www.citynature.ru/'.$category.'?start=' . $start;

            curl_setopt($curl, CURLOPT_URL, $url);

            $res = curl_exec($curl);

            file_put_contents('/var/www/kotik/storage/app/citynature.ru/'.str_replace('/', '_', $category).'_'.$start.'.html', $res);

            echo $url, "\n";
            sleep(rand(1, 3));
        }

    }
}
