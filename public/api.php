<?php

require_once '../src/Request/IRequest.php';
require_once '../src/Request/Request.php';
require_once '../src/Response/IResponse.php';
require_once '../src/Response/Response.php';
require_once '../src/Service/ExchangeRateService.php';

use App\Request\Request;
use App\Response\Response;
use App\Service\ExchangeRateService;

function run()
{
    $request = new Request();
    $exchangeRateService = new ExchangeRateService();
    $averageBuyRate = $exchangeRateService->getAverageBuyRate(
        $request->getCurrency(),
        $request->getStartDate(),
        $request->getEndDate());

    $response = new Response();
    $response->setBody(json_encode(['average_price' => $averageBuyRate]));
    $response->send();
}

run();
