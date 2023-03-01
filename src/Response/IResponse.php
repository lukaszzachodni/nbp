<?php

namespace App\Response;

interface IResponse {
    public function setBody(string $body): void;
    public function send(): void;
}
