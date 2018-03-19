<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;
use Carbon\Carbon;

class Product extends BaseModel
{

    protected $casts = [
        'source_created_at' => 'date',
        'source_modified_at' => 'date',
    ];

    public function category()
    {

        return $this->hasOne('App\Category', 'id', 'category_id')->where('parent_id', 0);

    }

    public function subCategories()
    {

        return $this->belongsToMany('App\Category')->where('parent_id', '!=', 0);

    }

    public function parent()
    {

        return $this->hasOne('App\Product', 'parent_id');

    }

    public function colors()
    {

        return $this->belongsToMany('App\Color');

    }

    public function keywords()
    {

        return $this->belongsToMany('App\Keyword');

    }

    public function origins()
    {

        return $this->belongsToMany('App\Origin');

    }

    public function stones()
    {

        return $this->belongsToMany('App\Stone');

    }

    public function styles()
    {

        return $this->belongsToMany('App\Style');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Artist');

    }

    /**
     * Returns web link to the product
     *
     * @return string
     */
    public function getWebUrlAttribute()
    {

        return env('PRODUCT_WEB_URL_PREFIX') .$this->id;

    }

    public function fillFrom($source)
    {

        $this->id = $source->id;
        $this->parent_id = $source->parentId;
        $this->category_id = $source->catId;
        $this->sku = $source->sku ?: null;
        $this->external_sku = $source->externalSku;
        $this->title = $source->name;
        $this->title_sort = $source->sortName;
        $this->image_url = $source->image;
        $this->description = $source->description;
        $this->priority = $source->priority;
        $this->price = $source->price;
        $this->sale_price = $source->salePrice;
        $this->member_price = $source->memberPrice;
        $this->aic_collection = $source->aicCollection;
        $this->gift_box = $source->giftBox;
        $this->recipient = $source->recipient;
        $this->holiday = $source->holiday;
        $this->architecture = $source->architecture;
        $this->glass = $source->glass;
        $this->x_shipping_charge = $source->xShippingCharge;
        $this->inventory = $source->memberPrice;
        $this->choking_hazard = $source->chokingHazard;
        $this->back_order = $source->backorder;
        $this->back_order_due_date = $source->backorderDueDate;
        $this->source_created_at = (new Carbon($source->createdDate))->timestamp;
        $this->source_modified_at = (new Carbon($source->lastUpdated))->timestamp;

        foreach ($source->facets as $f)
        {

            if ($f->type == 1 || $f->type == 2)
            {

                $this->subCategories()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 3)
            {

                $this->artists()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 4)
            {

                $this->colors()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 5)
            {

                $this->origins()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 7)
            {

                $this->stones()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 8)
            {

                $this->keywords()->syncWithoutDetaching($f->id);

            }
            elseif ($f->type == 9)
            {

                $this->styles()->syncWithoutDetaching($f->id);

            }
            else
            {

                throw new \Exception("I'm not sure what to do with a facet of the type " .$f->type ." on product #" .$f->id);

            }
        }
    }
}