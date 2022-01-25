<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\CategoriesImport;
use App\Imports\DepartmentsImport;
use App\Imports\ManufacturersImport;
use App\Imports\ProductsImport;
use App\Imports\DescriptionsImport;
use App\Imports\ProductDescriptionImport;

class CSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse CSV file';

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
     * @return int
     */
    public function handle()
    {
        $path = base_path() . '/public/csv/product_categories.csv';
        
        if(!file_exists($path))
            return $this->error('File not found!');
        
        \Excel::import(new CategoriesImport, $path);
        \Excel::import(new DepartmentsImport, $path);
        \Excel::import(new ManufacturersImport, $path);
        \Excel::import(new ProductsImport, $path);
        \Excel::import(new DescriptionsImport, $path);
        \Excel::import(new ProductDescriptionImport, $path);
        
        
        $this->info('The command was successful!');
    }
}
