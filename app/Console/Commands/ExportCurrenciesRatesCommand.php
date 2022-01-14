<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Throwable;

class ExportCurrenciesRatesCommand extends Command
{
    protected $signature = 'export:currencies-rates';
    protected $description = 'Export actual currencies rates';

    public function handle()
    {
        foreach (config('currencies.sources') as $source) {
            try {
                $source['exporter']::export($source['url'], $source['currency']);
                $this->info('Success export from ' . $source['url']);
            } catch (Throwable $e) {
                $this->error($e->getMessage());
                logs()->error($e->getMessage());
            }
        }
    }
}
