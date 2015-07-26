<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CityNatureProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citynature:products';

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

        $catalog = \App\Helpers\CitynatureHelper::getCatalogArrayFromCsvFile( base_path('storage/app/price1.csv') );
        $this->info('Catalog count = ' . count($catalog));
        foreach ($catalog as $item) {

            if (\App\Models\Product::where('code', '=', $item->index)->first()) {
                continue;
            }

            $product = new \App\Models\Product;
            $product->name = $item->title;
            $product->catalog_id = 1;
            $product->code = $item->index;
            $product->article = $item->article;
            $product->save();
            $product->setAttributeById(1, $item->volume);   // weight
            $product->setAttributeById(4, $item->article);  // article
            $product->setPriceByColumnId(18, $item->price_1);
            $product->setPriceByColumnId(19, $item->price_2);
            $product->setPriceByColumnId(20, $item->price_3);
            $product->setPriceByColumnId(21, $item->price_4);
            echo '.';
        }
        echo "\n";
    }
}
