<?php

declare(strict_types=1);

namespace Web3\Cli\Watchers;

use Symfony\Component\Console\Output\ConsoleOutputInterface;
use function Termwind\renderUsing;
use Web3\Cli\Contracts\Watcher;
use Web3\Cli\Contracts\WatcherButOnlyOnce;
use Web3\Exceptions\ErrorException;
use Web3\Exceptions\TransporterException;
use Web3\Web3;

/**
 * @internal
 */
final class EnsureRunning implements WatcherButOnlyOnce
{
    /**
     * If the Server is running.
     */
    private $running = false;

    /**
     * Creates a Watcher instance.
     */
    public function __construct(private Web3 $web3, private ConsoleOutputInterface $output)
    {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function watch(): void
    {
        if ($this->running) {
            return;
        }

        renderUsing($this->output);

        try {
            $this->web3->clientVersion();

            $this->running = true;
        } catch (TransporterException|ErrorException) {
            sleep(1);

            $this->watch();
        }
    }
}
