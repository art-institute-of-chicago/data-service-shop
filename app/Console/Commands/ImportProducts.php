<?php

namespace App\Console\Commands;

use League\Csv\Reader;
use Carbon\Carbon;
use App\Product;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportProducts extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products
                            {--reset : Truncate the products table first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products into the database';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->option('reset'))
        {
            Product::query()->truncate();
        }

        // Flysystem seems a bit overkill for such a simple operation
        $path = storage_path( 'app/Datahub/DatahubChainDriveProductData.csv' );

        $csv = Reader::createFromPath( $path, 'r' );
        $csv->setHeaderOffset(0);

        $csv->getHeader();
        $records = $csv->getRecords();

        foreach( $records as $datum ) {
            if (empty($datum['title'])) {
                continue;
            }

            $product = \App\Product::findOrNew( $datum['id'] );

            $product->id = $datum['id'];
            $product->title = $datum['title'];
            $product->external_sku = $datum['external_sku'];
            $product->source_modified_at = new Carbon( $datum['load_date'] );
            $product->min_compare_at_price = floatval($datum['min_compare_at_price']);
            $product->max_compare_at_price = floatval($datum['max_compare_at_price']);
            $product->min_current_price = floatval($datum['min_current_price']);
            $product->max_current_price = floatval($datum['max_current_price']);
            $product->artwork_ids = explode(',', $datum['artwork_ids']);
            $product->artist_ids = explode(',', $datum['artist_ids']);
            $product->exhibition_ids = explode(',', $datum['exhibition_ids']);

            $product->save();
        }
    }
}
