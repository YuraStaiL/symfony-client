<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\ResponseInterface;

#[AsCommand(
    name: 'groups:users-list',
    description: 'print table - group users',
)]
class PrintGroupUsersCommand extends CallApiCommand
{
    public function initArguments(): void
    {
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getApiRoute(InputInterface $input): string
    {
        return "/api/groups/users-list";
    }

    public function printResults(ResponseInterface $response, SymfonyStyle $style): void
    {
        $data = json_decode($response->getContent(false), true);
        $table = $style->createTable();
        $table->setHeaders(['User ID', 'Name', 'Email']);
        $table->setStyle('default');
        $table->setColumnWidths([20, 20, 20]);
        foreach ($data as $row) {
            $table->setHeaderTitle(sprintf('Group: %s', $row['name']));
            $users = $row['users'];
            $usersRows = [];
            foreach ($users as $user) {
                $usersRows[] = [$user['id'], $user['name'], $user['email']];
            }
            $table->setRows($usersRows);
            $table->render();
            $style->newLine();
        }

        if (!$data) {
            $style->info('no groups found');
        }
    }
}
