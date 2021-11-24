<?php

declare(strict_types=1);

namespace Web3\Cli\Watchers;

use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use function Termwind\renderUsing;
use Web3\Cli\Contracts\Watcher;
use Web3\Cli\Support\View;
use Web3\ValueObjects\Wei;
use Web3\Web3;

/**
 * @internal
 */
final class Accounts implements Watcher
{
    /**
     * The Process section.
     */
    private ConsoleSectionOutput $section;

    /*
     * The Gas Price.
     */
    private ?Wei $gasPrice = null;

    /**
     * Creates a Watcher instance.
     */
    public function __construct(private Web3 $web3, ConsoleOutputInterface $output)
    {
        $this->section = $output->section();
    }

    public function watch(): void
    {
        renderUsing($this->section);

        $accounts = [];

        foreach ($this->web3->eth()->accounts() as $address) {
            $accounts[$address] = $this->web3->eth()->getBalance($address);
        }

        $this->gasPrice = $this->gasPrice ?: $this->web3->eth()->gasPrice();

        $this->section->clear();

        View::render('accounts', [
            'accounts' => $accounts,
            'gasPrice' => $this->gasPrice,
        ]);
    }
}
