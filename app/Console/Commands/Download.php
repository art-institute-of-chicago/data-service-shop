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
        $file = $resource . '.json';

        $url = env('SHOP_API') . $resource;
        $proxy = env('CURL_PROXY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $contents = curl_exec($ch);

        curl_close($ch);

        Storage::put($file, $contents);

        $this->info('Saved ' . $file);
    }

}
