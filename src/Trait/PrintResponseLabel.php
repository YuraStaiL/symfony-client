<?php

namespace App\Trait;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\ResponseInterface;

trait PrintResponseLabel
{
    use CheckHttpCode;

    public function printResponseLabel(
        SymfonyStyle $output,
        ResponseInterface $response
    ) {
        if ($this->isSuccess($response->getStatusCode())) {
            $output->success($response->getStatusCode());
        } else {
            $output->error($response->getStatusCode());
        }
    }
}