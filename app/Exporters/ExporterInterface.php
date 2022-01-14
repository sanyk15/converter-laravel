<?php

namespace App\Exporters;

interface ExporterInterface
{
    public static function export(string $source, string $mainCurrency);
}
