<?php

declare(strict_types=1);

namespace Web3\Cli\Guards;

use Symfony\Component\Process\Process;
use Web3\Cli\Contracts\Guard;
use Web3\Cli\Exceptions\FriendlyConsoleException;

/**
 * @internal
 */
final class EnsureNpmIsGloballyAvailable implements Guard
{
    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $result = Process::fromShellCommandline('npm --version')->mustRun();

        if ($result->isSuccessful() === false) {
            throw new FriendlyConsoleException('Missing requirement', 'The Web3 CLI currently requires npm version ^8.0.');
        }
    }
}
