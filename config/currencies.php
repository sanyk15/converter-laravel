<?php

use App\Exporters\BitcoinExporter;
use App\Exporters\EcbExporter;

return [
    'default' => 'eur',
    'precision' => 4,

    'sources' => [
        [
            'url' => 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
            'currency' => 'eur',
            'exporter' => EcbExporter::class
        ],
        [
            'url' => 'https://api.coindesk.com/v1/bpi/historical/close.json',
            'currency' => 'usd',
            'exporter' => BitcoinExporter::class,
        ]
    ]
];
