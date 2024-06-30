<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'groups:update',
    description: 'update group (PUT)',
)]
class GroupUpdateCommand extends CallApiCommand
{
    public function initArguments(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'user id required')
            ->addArgument('name', InputArgument::REQUIRED, 'name required');
    }

    public function getHttpMethod(): string
    {
        return 'PUT';
    }

    public function getParams(InputInterface $input): array
    {
        return [
            'body' =>  [
                'name'      => $input->getArgument('name'),
            ]
        ];
    }

    public function getApiRoute(InputInterface $input): string
    {
        $id = $input->getArgument('id');

        return "/api/groups/$id";
    }
}
