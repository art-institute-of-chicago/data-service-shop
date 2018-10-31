<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Keyword;
use App\Style;
use App\Origin;
use App\Color;
use App\Stone;
use App\Artist;
use App\Product;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportIncremental extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:incremental';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import resources that have been added since the last import';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->import( Category::class );
        $this->import( Keyword::class );
        $this->import( Style::class );
        $this->import( Origin::class );
        $this->import( Color::class );
        $this->import( Stone::class );
        $this->import( Artist::class );
        $this->import( Product::class );

    }

    public function import($class)
    {

        $filename = $this->fileName($class);

        if (!Storage::exists($filename))
        {
            $this->error($filename .' does not exist. Please run `php artisan download` to get all the JSON files locally, first.');
            exit;
        }

        $contents = Storage::get($filename);
        $res = json_decode($contents);

        foreach ($res->data as $d)
        {

            $id = $this->idField($class);
            if (is_array($id))
            {
                $resource = $class::find([$id[0] => snake_case($id[0]), $id[1] => snake_case($id[1])])->first();
                if (!$resource)
                {
                    $resource = new $class;
                }
            }
            else
            {
                $resource = $class::findOrNew($d->$id);
            }
            $resource->fillFrom($d);
            $resource->save();

        }

    }

    public function fileName($class)
    {

        $basename = strtolower(class_basename($class));

        if ($class != \App\Origin::class)
        {
            $basename = str_plural($basename);
        }

        return $basename .'.json';

    }

    public function idField($class)
    {

        switch ($class)
        {
            case Keyword::class:
                return 'keywordId';
                break;
            case Color::class:
                return 'colorId';
                break;
            case Origin::class:
                return 'originId';
                break;
            case Stone::class:
                return 'stoneId';
                break;
            case Style::class:
                return 'styleId';
                break;
            case Category::class:
                return ['id', 'parentId'];
                break;
        }

        return 'id';

    }

}
