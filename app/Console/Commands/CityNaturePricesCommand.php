<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CityNaturePricesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citynature:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
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

        return;

        $catalog = \App\Helpers\CitynatureHelper::getCatalogArrayFromCsvFile( base_path('storage/app/price1.csv') );
        $this->info('Catalog count = ' . count($catalog));

        $this->output->progressStart(count($catalog));

        foreach ($catalog as $item) {

            \App\Models\ProductPrice::create([
                'name' => $item->title,
                'code' => $item->index,
                'article' => $item->article,
                'price_1' => $item->price_1,
                'price_2' => $item->price_2,
                'price_3' => $item->price_3,
                'price_4' => $item->price_4
            ]);

            $this->output->progressAdvance();

        }

        $this->output->progressFinish();

    }
}
