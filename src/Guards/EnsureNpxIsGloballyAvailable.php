<?php

declare(strict_types=1);

namespace Web3\Cli;

use Symfony\Component\Process\Process;
use Web3\Cli\Contracts\Guard;

/**
 * @internal
 */
final class EnsureNpxIsGloballyAvailable implements Guard
{
    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $result = Process::fromShellCommandline('npx --version')->wait();

        // @todo...
    }
}
