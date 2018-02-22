<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Product;

class ImportProductsAll extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products-all';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all products';


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

        if (!Storage::exists('products.json'))
        {

            $this->error('products.json does not exist. Please run `php artisan download` to get all the JSON files locally, first.');
            exit;

        }

        $contents = Storage::get('products.json');
        $res = json_decode($contents);

        foreach ($res->data as $d)
        {

            $product = Product::findOrNew($d->id);
            $product->id = $d->id;
            $product->parent_id = $d->parentId;
            $product->category_id = $d->catId;
            $product->sku = $d->sku ?: null;
            $product->external_sku = $d->externalSku;
            $product->title = $d->name;
            $product->title_sort = $d->sortName;
            $product->image_url = $d->image;
            $product->description = $d->description;
            $product->priority = $d->priority;
            $product->price = $d->price;
            $product->sale_price = $d->salePrice;
            $product->member_price = $d->memberPrice;
            $product->aic_collection = $d->aicCollection;
            $product->gift_box = $d->giftBox;
            $product->recipient = $d->recipient;
            $product->holiday = $d->holiday;
            $product->architecture = $d->architecture;
            $product->glass = $d->glass;
            $product->x_shipping_charge = $d->xShippingCharge;
            $product->inventory = $d->memberPrice;
            $product->choking_hazard = $d->chokingHazard;
            $product->back_order = $d->backorder;
            $product->back_order_due_date = $d->backorderDueDate;
            $product->source_created_at = $d->createdDate;
            $product->source_modified_at = $d->lastUpdated;
            $product->member_price = $d->memberPrice;
            $product->member_price = $d->memberPrice;

            foreach ($d->facets as $f)
            {

                if ($f->type == 1 || $f->type == 2)
                {

                    $product->categories()->attach($f->id);

                }
                elseif ($f->type == 3)
                {

                    $product->artists()->attach($f->id);

                }
                elseif ($f->type == 4)
                {

                    $product->colors()->attach($f->id);

                }
                elseif ($f->type == 5)
                {

                    $product->origins()->attach($f->id);

                }
                elseif ($f->type == 7)
                {

                    $product->stones()->attach($f->id);

                }
                elseif ($f->type == 8)
                {

                    $product->keywords()->attach($f->id);

                }
                elseif ($f->type == 9)
                {

                    $product->styles()->attach($f->id);

                }
                else
                {

                    $this->warn("I'm not sure what to do with a facet of the type " .$f->type ." on product #" .$f->id);

                }

                $product->save();

            }

        }

    }

}
