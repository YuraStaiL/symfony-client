<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'users:create',
    description: 'create new user',
)]
class UserCreateCommand extends CallApiCommand
{
    public function initArguments(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'name required')
            ->addArgument('email', InputArgument::REQUIRED, 'email required')
            ->addArgument('userGroup', InputArgument::REQUIRED, 'user group id required');
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getParams(InputInterface $input): array
    {
        return [
            'body' =>  [
                'name'      => $input->getArgument('name'),
                'email'     => $input->getArgument('email'),
                'userGroup' => $input->getArgument('userGroup')
            ]
        ];
    }

    public function getApiRoute(InputInterface $input): string
    {
        return "/api/users";
    }
}
