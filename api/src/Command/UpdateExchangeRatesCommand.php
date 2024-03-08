<?php

namespace App\Command;

use App\HttpClient\Exceptions\AnyApiException;
use App\Service\AnyApiService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Request;

#[AsCommand(
    name: 'UpdateExchangeRatesCommand',
    description: 'SaveRatesToDB',
)]
class UpdateExchangeRatesCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('base', InputArgument::OPTIONAL, 'Base currency')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Fetch the AnyApiService from the service container
        $anyApiService = $this->getApplication()->getKernel()->getContainer()->get(AnyApiService::class);

        try {
            $request = Request::create(
                '/rates',
                'POST',
                ['base' => $input->getArgument('base')],
            );
            $anyApiService->getRates($request);

            // Output success message
            $io->success('Exchange rates updated successfully.');

            return Command::SUCCESS;
        } catch (AnyApiException|\JsonException $e) {
            // Output error message
            $io->error('Failed to update exchange rates: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }

}
