<?php

declare(strict_types=1);

namespace Web3\Cli\Commands;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Process\Process;
use Web3\Cli\Contracts\Command;
use Web3\Cli\Contracts\Watcher;
use Web3\Cli\Guards\EnsureNpmIsGloballyAvailable;
use Web3\Cli\Guards\KillsExistingServers;
use Web3\Cli\Support\DB;
use Web3\Cli\Support\View;
use Web3\Cli\Watchers;
use Web3\Web3;

/**
 * @internal
 */
final class Serve implements Command
{
    /**
     * @var array<int, class-string<Watcher>>
     */
    private static array $processors = [
        Watchers\EnsureRunning::class,
        Watchers\Accounts::class,
    ];

    /**
     * {@inheritDoc}
     */
    public function configure(SymfonyCommand $command): void
    {
        $command->addOption('accounts', null, InputOption::VALUE_REQUIRED, 'Number of accounts to generate at startup', '5');
        $command->addOption('host', null, InputOption::VALUE_REQUIRED, 'Hostname to listen on', '127.0.0.1');
        $command->addOption('port', null, InputOption::VALUE_REQUIRED, 'Port number to listen on', '8545');
    }

    /**
     * {@inheritDoc}
     */
    public function guards(): array
    {
        return [
            EnsureNpmIsGloballyAvailable::class,
            KillsExistingServers::class,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function run(InputInterface $input, ConsoleOutputInterface $output): void
    {
        $accounts = $this->getOption($input, 'accounts');
        $host     = $this->getOption($input, 'host');
        $port     = $this->getOption($input, 'port');

        $process = Process::fromShellCommandline(sprintf(
            'npm exec -- ganache-cli --accounts=%s --host %s --port %s', $accounts, $host, $port
        ))->setTimeout(0);

        $process->start();

        DB::set('server', (string) $process->getPid());

        View::info('http', sprintf(
            '<span>Listening on </span> <strong class="text-yellow"> %s:%s</strong>',
            $host,
            $port,
        ));

        $web3 = new Web3(sprintf('http://%s:%s', $host, $port));

        $processors = array_map(
            fn ($class) => new $class($web3, $output),
            self::$processors
        );

        while ($process->isRunning()) {
            foreach ($processors as $processor) {
                $processor->watch();
            }

            sleep(1);
        }
    }

    /**
     * Returns the given option value.
     */
    private function getOption(InputInterface $input, string $name): string
    {
        $value = $input->getOption($name);

        assert(is_string($value));

        return $value;
    }
}
