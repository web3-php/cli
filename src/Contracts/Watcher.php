<?php

declare(strict_types=1);

namespace Web3\Cli\Contracts;

/**
 * @internal
 */
interface Watcher
{
    /**
     * Process the information from the Web3 server.
     */
    public function watch(): void;
}
