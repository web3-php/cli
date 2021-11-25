<?php

declare(strict_types=1);

namespace Web3\Cli\Watchers;

use Web3\Cli\Contracts\Watcher;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Web3;

/**
 * @internal
 */
final class EnsureRunning implements Watcher
{
    /**
     * Creates a Watcher instance.
     */
    public function __construct(private Web3 $web3)
    {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function watch(): void
    {
        once(function () {
            try {
                $this->web3->clientVersion();
            } catch (TransporterException|ErrorException) {
                sleep(1);

                $this->watch();
            }
        });
    }
}
