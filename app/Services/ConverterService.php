<?php

namespace App\Services;

use App\Models\Currency;

class ConverterService
{
    protected $fromCurrency;
    protected $toCurrency;
    protected $amount;
    protected $convertedAmount;
    protected $precision;
    protected $defaultCurrency;

    public function __construct(string $defaultCurrency, int $precision)
    {
        $this->defaultCurrency = Currency::where('slug', $defaultCurrency)->first();
        $this->convertedAmount = 0;
        $this->precision = $precision;
    }

    public function convert($fromCurrency, $toCurrency, $amount): string
    {
        $this->fromCurrency = Currency::where('slug', $fromCurrency)->first() ?? $this->defaultCurrency;
        $this->toCurrency = Currency::where('slug', $toCurrency)->first() ?? $this->defaultCurrency;
        $this->amount = $amount;

        if ($fromCurrency == $toCurrency) {
            $this->convertedAmount = $this->amount;
        } else {
            $this->convertToDefault();
            $this->convertFromDefault();
        }

        return round($this->convertedAmount, $this->precision);
    }

    public function convertAndFormat($fromCurrency, $toCurrency, $amount): string
    {
        $this->convert($fromCurrency, $toCurrency, $amount);

        return $this->formatConverted();
    }

    private function convertToDefault(){
        $this->convertedAmount = $this->amount / $this->fromCurrency->rate;
    }

    private function convertFromDefault(){
        $this->convertedAmount = $this->convertedAmount * $this->toCurrency->rate;
    }

    private function formatConverted(): string
    {
        return number_format($this->convertedAmount, $this->precision, ',', ' ') . ' ' . strtoupper($this->toCurrency->slug);
    }
}
