<?php

namespace App\Exporters;

use App\Models\Currency;
use App\Services\ConverterService;
use Orchestra\Parser\Xml\Facade as XmlParser;

class EcbExporter implements ExporterInterface
{
    public static function export(string $source, string $mainCurrency)
    {
        $xml = XmlParser::load(url($source));

        foreach ($xml->getOriginalContent()->Cube->Cube->Cube as $item) {
            $rate = $item['rate'];

            if (strtolower($mainCurrency) !== config('currencies.default')) {
                $rate = app()->make(ConverterService::class)->convert($mainCurrency, config('currencies.default'), $item['rate']);
            }

            if ($currency = Currency::where('slug', strtolower($item['currency']))->first()) {
                $currency->update(['rate' => $rate]);
            } else {
                Currency::create([
                    'slug' => strtolower($item['currency']),
                    'rate' => $rate,
                ]);
            }
        }
    }
}
