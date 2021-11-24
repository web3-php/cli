<?php

declare(strict_types=1);

namespace Web3\Cli\Contracts;

use Symfony\Component\Console\Exception\ExceptionInterface;

/**
 * @internal
 */
interface Guard
{
    /**
     * Executes the Guard action.
     *
     * @throws ExceptionInterface
     */
    public function execute(): void;
}
