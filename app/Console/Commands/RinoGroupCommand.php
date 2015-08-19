<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RinoGroupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:rino {action=list}';

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

         $action_method_name = 'action_' . $this->argument('action');

         if (!method_exists($this, $action_method_name)) {
             $this->error('Bad action - ' . $this->argument('action'));
             return;
         }

         $this->$action_method_name();

     }

     public function action_list()
     {
         $this->info('action_list');
     }

     public function action_mk()
     {
         mkdir('/media/vitaly/ADATA/kotik/public/media/images/250x200');
     }

     public function action_load()
     {
         $source_file_content = \Storage::get('rino-group.csv');

         $source_file_rows = explode("\n", $source_file_content);

         array_shift($source_file_rows);

         if (empty($source_file_rows)) {
             $this->error('Массив пуст');
             return;
         }

         $source_file_rows = array_slice($source_file_rows, 8);

         $this->output->progressStart(count($source_file_rows));

         foreach ($source_file_rows as $row) {

             $row = trim($row);

             if (empty($row)) {
                 continue;
             }

             $fields = explode(';', $row);

             $product_model = \App\Models\Product::create([
                 // ID
                 'code' => trim($fields[1]),
                 // Артикул
                 'article' => '',
                 // Наименование товара
                 'name' => trim($fields[2]),
                 // Категория товара
                 'category_name' => '',
                 // Производитель
                 'brand' => trim($fields[3]),
                 // Количество в упаковке
                 'in_packing' => intval($fields[4]),
                 // Цена
                 'price_1' => trim($fields[5]),
                 'catalog_id' => 3,
             ]);

             $this->output->progressAdvance();
         }

         $this->output->progressFinish();
     }
}
