<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Product;

class ImportIncremental extends Command
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

        $this->import(\App\Category::class);
        $this->import(\App\Keyword::class);
        $this->import(\App\Style::class);
        $this->import(\App\Origin::class);
        $this->import(\App\Color::class);
        $this->import(\App\Stone::class);
        $this->import(\App\Artist::class);
        $this->import(\App\Product::class);

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

        if ($class == \App\Keyword::class)
        {

            return 'keywordId';

        }
        elseif ($class == \App\Color::class)
        {

            return 'colorId';

        }
        elseif ($class == \App\Origin::class)
        {

            return 'originId';

        }
        elseif ($class == \App\Stone::class)
        {

            return 'stoneId';

        }
        elseif ($class == \App\Style::class)
        {

            return 'styleId';

        }
        elseif ($class == \App\Category::class)
        {

            return ['id', 'parentId'];

        }

        return 'id';

    }

}
