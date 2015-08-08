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
        return;

        $links_arr = include '/var/www/kotik/storage/app/citynature_urls.php';

        foreach ($links_arr as $link) {
            $file_name = 'citynature_pages/' . md5($link) . '.html';

            $exists = \Storage::exists($file_name);

            if (!$exists) {
                continue;
            }

            $file_content = \Storage::get($file_name);

            preg_match('@<h1>(.+)</h1>@si', $file_content, $product_name);
            preg_match('@<span class="ean">([^<]+)</span>@si', $file_content, $article);
            preg_match('@<p>Категория\: <a href="[/a-z0-9_-]{1,}">([^<]+)</a></p>@si', $file_content, $category);
            preg_match('@<p class="manufacturer_name">Бренд:[\s]{0,}<a class = "bolder_cart_product" href = "[/a-z0-9_-]{1,}">([^<]+)</a>[\s]{0,}, <a href="[/a-z0-9_-]{1,}">([^<]+)</a>[\s]{0,}</p>@si', $file_content, $brand_country);
            preg_match('@<p>Линейка товаров: <a href="[/#a-z0-9_-]{1,}">([^<]+)</a></p>@si', $file_content, $products_line);
            preg_match('@<span>([0-9\s]+) (мл|мг)+</span>@si', $file_content, $value);
            preg_match('@<div class="qty_in_stock">В наличии:[\s]{0,}<span >([0-9]+)</span>&nbsp;[\s]{0,}Мин. партия: от <span>([0-9]+)</span> шт.[\s]{0,}</div>@si', $file_content, $part);
            preg_match('@<div class="jshop_prod_description"style = "margin-top:60px;">(.+?)</div>@si', $file_content, $description);

            preg_match_all('@<a class="lightbox" id="main_image_full_[\d]+" href="([^"]+)"@si', $file_content, $images);

            $product_name  = !empty($product_name)  ? trim($product_name[1])  : '';
            $article       = !empty($article)       ? trim($article[1])       : '';
            $category      = !empty($category)      ? trim($category[1])      : '';
            $brand         = !empty($brand_country) ? trim($brand_country[1]) : '';
            $country       = !empty($brand_country) ? trim($brand_country[2]) : '';
            $products_line = !empty($products_line) ? trim($products_line[1]) : '';
            $images        = !empty($images)        ? $images[1]              : [];

            $weight = !empty($value) ? $value[1] : '';
            $weight = str_replace(' ', '', $weight);
            $measure_unit = !empty($value) ? trim($value[2]) : '';


            $description = !empty($description) ? $description[1] : '';
            $description = str_replace("</p>", "\n", $description);
            $description = strip_tags($description);
            $description = preg_replace('/Описание:/', '', $description);
            $description = trim($description);


            $in_stock = !empty($part) ? trim($part[1]) : 0;
            $min_party = !empty($part) ? trim($part[2]) : 0;

            $product_model = \App\Models\Product::create([
                'article'      => $article,
                'name'         => $product_name,
                'description'  => $description,
                'source_url'   => $link,
                'brand'        => $brand,
                'country_name' => $country,
                'weight'       => $weight,
                'measure_unit' => $measure_unit,
                'in_stock'     => $in_stock,
                'min_party'    => $min_party,
                'category_name'=> $category,
                'product_line' => $products_line
            ]);

            if (!empty($images)) {
                foreach ($images as $image) {

                    $media_model = new \App\Models\Media();
                    $media_model->product_id = $product_model->id;
                    $media_model->source_url = $image;
                    $media_model->save();

                }
            }

        }

        return;

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
