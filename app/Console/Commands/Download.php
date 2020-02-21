<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class Download extends BaseCommand
{

    protected $signature = 'download';

    protected $description = "Download JSON of all shop data";

    /**
     * Download JSON of all shop data.
     */
    public function handle()
    {

        $this->downloadFile('products');
        $this->downloadFile('facets');
        $this->downloadFile('categories');
        $this->downloadFile('keywords');
        $this->downloadFile('styles');
        $this->downloadFile('origin');
        $this->downloadFile('colors');
        $this->downloadFile('stones');
        $this->downloadFile('artists');

    }

    private function downloadFile($resource)
    {
        $file = $resource .'.json';

        Storage::put($file, file_get_contents(env('SHOP_API') .$resource));

        $this->info('Saved ' . $file);
    }

}
