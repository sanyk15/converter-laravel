<?php

namespace App\Exporters;

use App\Models\Currency;
use App\Services\ConverterService;
use Carbon\Carbon;

class BitcoinExporter implements ExporterInterface
{
    public static function export(string $source, string $mainCurrency)
    {
        $json = file_get_contents(url($source));
        $object = json_decode($json);

        $currencyCode = 'btc';
        $rate = $object->bpi->{Carbon::now()->subDay()->format('Y-m-d')};

        if ($mainCurrency !== config('currencies.default')) {
            $rate = app()->make(ConverterService::class)->convert($mainCurrency, config('currencies.default'), $rate);
        }

        if ($currency = Currency::where('slug', $currencyCode)->first()) {
            $currency->update(['rate' => $rate]);
        } else {
            Currency::create([
                'slug' => $currencyCode,
                'rate' => $rate,
            ]);
        }
    }
}
