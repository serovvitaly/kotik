<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class CoolBabyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:coolbaby {action=list}';

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

        $action_method_name = 'action_' . $this->argument('action');

        if (!method_exists($this, $action_method_name)) {
            $this->error('Bad action - ' . $this->argument('action'));
            return;
        }

        $this->$action_method_name();

    }

    public function action_foo()
    {
        $this->output->progressStart(10);

        for ($i = 0; $i <= 10; $i++) {

            sleep(1);

            $this->output->progressAdvance();

        }

        $this->output->progressFinish();
    }

    public function action_list()
    {
        $this->info('action_list');
    }

    public function action_clear()
    {
        $products = \App\Models\Product::where('catalog_id', '=', 2)->get();

        $this->output->progressStart(count($products));

        foreach ($products as $product) {

            $this->info($product->id);

            $product->images()->delete();

            $product->delete();

            $this->output->progressAdvance();

        }

        $this->output->progressFinish();
    }

    public function action_parse()
    {
        $source_file_content = \Storage::get('coolbaby_11082015.csv');

        $source_file_rows = explode("\n", $source_file_content);

        array_shift($source_file_rows);

        if (empty($source_file_rows)) {
            $this->error('Массив пуст');
            return;
        }

        $this->output->progressStart(count($source_file_rows));

        foreach ($source_file_rows as $row) {

            $row = trim($row);

            if (empty($row)) {
                continue;
            }

            $fields = explode(';', $row);

            $product_model = \App\Models\Product::create([
                // ID
                'code' => trim($fields[0]),
                // Артикул
                'article' => trim($fields[1]),
                // Наименование товара
                'name' => trim($fields[2]),
                // Категория товара
                'category_name' => trim($fields[3]),
                // Производитель
                'brand' => trim($fields[4]),
                // Цена оптовая
                'price_2' => trim($fields[5]),
                // Цена розничная в интернет-магазине Coolbaby
                'price_1' => trim($fields[6]),
                'catalog_id' => 2,
            ]);

            $source_url = 'http://' . substr(trim($fields[7]), 0, -4) . '_big.jpg';

            $media_model = new \App\Models\Media();
            $media_model->product_id = $product_model->id;
            $media_model->source_url = $source_url;
            $media_model->save();

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
