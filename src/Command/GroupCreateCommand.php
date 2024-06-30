<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'groups:create',
    description: 'create new user group',
)]
class GroupCreateCommand extends CallApiCommand
{
    public function initArguments(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'name required');
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getParams(InputInterface $input): array
    {
        return [
            'body' =>  [
                'name' => $input->getArgument('name'),
            ]
        ];
    }

    public function getApiRoute(InputInterface $input): string
    {
        return "/api/groups";
    }
}
