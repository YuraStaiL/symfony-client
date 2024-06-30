<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'groups:get',
    description: 'get group by id',
)]
class GroupGetCommand extends CallApiCommand
{
    public function initArguments(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'group id required');
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getApiRoute(InputInterface $input): string
    {
        $id = $input->getArgument('id');

        return "/api/groups/$id";
    }
}
