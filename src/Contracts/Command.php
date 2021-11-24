<?php

declare(strict_types=1);

namespace Web3\Cli\Contracts;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

/**
 * @internal
 */
interface Command
{
    /**
     * Configures the Command.
     */
    public function configure(SymfonyCommand $command): void;

    /**
     * Returns the Command Guards.
     *
     * @return array<int, class-string<Guard>>
     */
    public function guards(): array;

    /**
     * Runs the Command.
     */
    public function run(InputInterface $input, ConsoleOutputInterface $output): void;
}
