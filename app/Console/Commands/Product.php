<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Product extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product {action=help}';

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

        $action_method_name = str_replace('-', '_', $action_method_name);

        if (!method_exists($this, $action_method_name)) {
            $this->error('Bad action - ' . $this->argument('action'));
            return;
        }

        $this->$action_method_name();
    }

    public function action_help()
    {
        $this->info('update-price - обновление актуальных цен на товары');
        $this->info('update-status - обновление статусов товаров');
        $this->info('update-count - обновление колличества предложений для товаров');
    }

    public function action_update_all()
    {
        \App\Helpers\ProductHelper::massUpdateProductsPrices();

        \App\Helpers\ProductHelper::massUpdateProductsStatuses();

        \App\Helpers\ProductHelper::massUpdateProductsOffersCounts();
    }

    public function action_update_price()
    {
        \App\Helpers\ProductHelper::massUpdateProductsPrices();
    }

    public function action_update_status()
    {
        \App\Helpers\ProductHelper::massUpdateProductsStatuses();
    }

    public function action_update_count()
    {
        \App\Helpers\ProductHelper::massUpdateProductsOffersCounts();
    }
}
