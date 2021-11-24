<?php

declare(strict_types=1);

namespace Web3\Cli\Contracts;

use Web3\Cli\Exceptions\FriendlyConsoleException;

/**
 * @internal
 */
interface Guard
{
    /**
     * Executes the Guard action.
     *
     * @throws FriendlyConsoleException
     */
    public function execute(): void;
}
