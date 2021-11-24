<?php

declare(strict_types=1);

namespace Web3\Cli\Exceptions;

use Exception;
use Symfony\Component\Console\Exception\ExceptionInterface;

/**
 * @internal
 */
final class FriendlyConsoleException extends Exception implements ExceptionInterface
{
    /**
     * Creates a new FriendlyConsoleException instance.
     */
    public function __construct(private string $title, private string $description)
    {
        parent::__construct(sprintf('%s: %s', $title, $description), 1);
    }

    /**
     * Returns the exception title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Returns the exception description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
