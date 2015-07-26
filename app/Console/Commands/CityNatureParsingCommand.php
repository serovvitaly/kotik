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
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true
        ]);

        $category = 'cosmetic';

        for ($start = 0; $start <= 7040; $start += 10) {
            $url = 'http://www.citynature.ru/'.$category.'?start=' . $start;

            curl_setopt($curl, CURLOPT_URL, $url);

            $res = curl_exec($curl);

            file_put_contents('/var/www/kotik/storage/app/citynature.ru/'.$category.'_'.$start.'.html', $res);

            echo $url, "\n";
            sleep(rand(1, 3));
        }

    }
}
