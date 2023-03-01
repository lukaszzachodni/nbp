<?php

namespace App\Response;

class Response implements IResponse {
    private string $body = '';

    public function setBody(string $body): void {
        $this->body = $body;
    }

    public function send(): void {
        echo $this->body;
    }
}
