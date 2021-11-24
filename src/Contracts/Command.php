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
     * Runs the Command.
     */
    public function run(InputInterface $input, ConsoleOutputInterface $output): void;
}
