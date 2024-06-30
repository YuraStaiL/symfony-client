<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'groups:delete',
    description: 'delete group',
)]
class GroupDeleteCommand extends CallApiCommand
{
    public function initArguments(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'group id required');
    }

    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getApiRoute(InputInterface $input): string
    {
        $id = $input->getArgument('id');

        return "/api/groups/$id";
    }
}
