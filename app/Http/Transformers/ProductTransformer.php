<?php

namespace App\Http\Transformers;

use DOMDocument;
use DOMXPath;

use Aic\Hub\Foundation\AbstractTransformer;

class ProductTransformer extends AbstractTransformer
{

    public function transform($product)
    {

        $data = [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $this->getCleanHtml($product->description),
            'external_sku' => $product->external_sku,
            'min_compare_at_price' => $product->min_compare_at_price ?: null,
            'max_compare_at_price' => $product->max_compare_at_price ?: null,
            'min_current_price' => $product->min_current_price ?: null,
            'max_current_price' => $product->max_current_price ?: null,
            'artwork_ids' => array_filter(array_map('floatval', $product->artwork_ids)),
            'artist_ids' => array_filter(array_map('floatval', $product->artist_ids)),
            'exhibition_ids' => array_filter(array_map('floatval', $product->exhibition_ids)),
            'modified_at' => $product->source_modified_at ? $product->source_modified_at->toIso8601String() : null,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

    /**
     * Removes empty paragraphs, ordered and unordered lists
     * Reconciles spacing
     * Replaces curly quotes with straight equivalent
     *
     * Adapted from the following gist:
     *
     * @link https://gist.github.com/u01jmg3/a220f20a99f942f4a692b95fa928f02a
     *
     * @param  $html
     * @return string
     */
    private static function getCleanHtml($html)
    {
        if (empty($html)) {
            return null;
        }

        // Fastest way of removing unwanted tags
        $html = strip_tags($html, '<p><ol><ul><li><em><br>');

        // Replace `&nbsp;` with a space character throughout (it prevents run-on sentences breaking out of layout)
        $html = str_replace('&nbsp;', ' ', $html);

        // More personal annoyances!
        $html = preg_replace('/<em>\s+/u', ' <em>', $html);
        $html = preg_replace('/\s+<\/em>/u', '</em> ', $html);
        $html = str_replace('</em><em>', '', $html);
        $html = str_replace(',</em>', '</em>,', $html);
        $html = str_replace('.</em>', '</em>.', $html);

        // Replace multiple spaces with a single space
        // `u` also targets unicode \u00a0
        $html = preg_replace('/[[:space:]]+/u', ' ', $html);

        // Remove leading and trailing spaces from within an HTML string
        $html = preg_replace('/(?<=p>)\s+|\s+(?=<\/p)/u', '', $html);

        // Convert curly quotes to straight equivalent
        // $replacements = [
        //     "\xE2\x80\x98" => "'",   // ‘
        //     "\xE2\x80\x99" => "'",   // ’
        //     "\xE2\x80\x9A" => "'",   // ‚
        //     "\xE2\x80\x9B" => "'",   // ‛
        //     "\xE2\x80\x9C" => '"',   // “
        //     "\xE2\x80\x9D" => '"',   // ”
        //     "\xE2\x80\x9E" => '"',   // „
        //     "\xE2\x80\x9F" => '"',   // ‟
        //     "\xE2\x80\x93" => '-',
        //     "\xE2\x80\x94" => '--',
        //     "\xE2\x80\xa6" => '...',
        // ];
        // $html = strtr($html, $replacements);

        try {
            // Do not ignore malformed HTML
            // libxml_use_internal_errors(true) && libxml_clear_errors();
            $dom = new DOMDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
            $html  = ''; // Clear var for returning output
            $xpath = new DOMXPath($dom);

            // Remove empty tags
            foreach ($xpath->query('//*[not(node())]') as $node) {
                if ($node->nodeName === 'br') {
                    continue;
                }
                $node->parentNode->removeChild($node);
            }

            // Remove all attributes
            foreach ($xpath->query('//*') as $node) {
                for ($i = $node->attributes->length -1; $i >= 0; $i--) {
                    $attribute = $node->attributes->item($i);
                    $node->removeAttributeNode($attribute);
                }
            }

            // We are only interested in saving the `body` content
            $body     = $xpath->query('//body');
            $children = $body->item(0)->childNodes;
            foreach ($children as $child) {
                $html .= $child->ownerDocument->saveHtml($child);
            }
        } catch (\Throwable $e) {
            return null;
        }

        return $html;
    }
}
