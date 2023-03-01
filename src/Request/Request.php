<?php

namespace App\Request;

class Request
{
    private string $currency;
    private string $startDate;
    private string $endDate;

    public function __construct()
    {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        $params = array_values(array_diff($requestUri, $scriptName));
        $this->currency = $params[0];
        $this->startDate = $params[1];
        $this->endDate = $params[2];
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }
}
