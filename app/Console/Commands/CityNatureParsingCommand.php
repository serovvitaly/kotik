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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $file_content = file_get_contents('/var/www/kotik/storage/app/citynature.ru/bytovaya-khimiya_20.html');

        // <a style = "" href="/bytovaya-khimiya/otbelivateli/ekologicheskij-kislorodnyj-otbelivatel-dlya-stirki-v-poroshke" rel="nofollow">Экологический кислородный отбеливатель для стирки в порошке</a>
        // <span style = "color:#363636;font-weight:bolder;">14040</span>

        preg_match_all('@\<a style = "" href="([-a-z\./_0-9]+)" rel="nofollow"\>([\sа-я]+)\<\/a\>@iu', $file_content, $links);
        preg_match_all('@\<span style = "color\:\#363636\;font-weight\:bolder\;"\>([A-Z0-9]+)\<\/span\>@i', $file_content, $articles);
        preg_match_all('@Мин\. партия\: от \<span\>(\d*)\<\/span\>@i', $file_content, $parts);

        print_r($links);
        //print_r($articles[1]);
        //print_r($parts[1]);

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
