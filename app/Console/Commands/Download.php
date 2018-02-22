<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class Download extends Command
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

        $res = $this->queryService($resource);

        $file = $resource .'.json';

        Storage::put($file, json_encode($res, JSON_PRETTY_PRINT));

        $this->info('Saved ' . $file);

    }

    private function queryService($endpoint)
    {

        $res = file_get_contents(env('SHOP_API') .$endpoint);

        return json_decode($res);

    }

}
