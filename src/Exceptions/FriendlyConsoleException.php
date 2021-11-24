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
     * Creates a new FriendlyConsoleException with the given message.
     */
    public static function withMessage(string $message): self
    {
        return new self($message, 1);
    }
}
