<?php

namespace App\Command;

use App\Trait\PrintResponseLabel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class CallApiCommand extends Command
{
    use PrintResponseLabel;

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->initArguments();
    }

    abstract public function initArguments();
    abstract public function getHttpMethod();

    abstract public function getApiRoute(InputInterface $input);

    public function getParams(InputInterface $input): array
    {
        return [];
    }

    public function printResults(ResponseInterface $response, SymfonyStyle $style): void
    {
        $data = json_decode($response->getContent(false), true);
        $this->printResponseLabel($style, $response);
        $style->writeln('Response:');
        print_r($data);
    }

    public function getHostUrl(): string
    {
        return $_ENV['API_URL'] ?? 'http://localhost:888';
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $apiUrl = $this->getHostUrl() . $this->getApiRoute($input);

        $response = $this
            ->httpClient
            ->request(
                $this->getHttpMethod(),
                $apiUrl,
                $this->getParams($input));

        $this->printResults($response, $io);

        return Command::SUCCESS;
    }
}
