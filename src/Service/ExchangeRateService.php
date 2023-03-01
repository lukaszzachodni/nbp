<?php

namespace App\Service;

class ExchangeRateService {
    private string $nbpUrl = 'http://api.nbp.pl/api/exchangerates/rates/C/%s/%s/%s/';

    private array $currencyMapping = [
        'USD' => 'usd',
        'EUR' => 'eur',
        'CHF' => 'chf',
        'GBP' => 'gbp',
    ];

    public function getAverageBuyRate(string $currency, string $startDate, string $endDate): float {
        if (!array_key_exists($currency, $this->currencyMapping)) {
            throw new \InvalidArgumentException("Unsupported currency: $currency");
        }
        $rates = $this->getRates($currency, $startDate, $endDate);

        return $this->calcAverage($rates);
    }

    protected function getRates(string $currency, string $startDate, string $endDate): array
    {
        $url = sprintf($this->nbpUrl, $currency, $startDate, $endDate);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        
        return $data['rates']??[];
    }

    protected function calcAverage(array $rates): float
    {
        $sum = 0;
        foreach ($rates as $rate) {
            $sum += $rate['bid'];
        }

        return (float) $sum / count($rates);
    }
}
