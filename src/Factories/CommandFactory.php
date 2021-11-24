<?php

declare(strict_types=1);

namespace Web3\Cli\Factories;

use ReflectionClass;
use Symfony\Component\Console\Command\Command;

/**
 * @internal
 */
final class CommandFactory
{
    /**
     * Creates a new Command instance.
     *
     * @param array<int, class-string<\Web3\Cli\Contracts\Command>> $commands
     *
     * @return array<int, Command>
     *
     * @throws \ReflectionException
     */
    public static function make(array $commands): array
    {
        return array_map(function (string $command): Command {
            /** @var \Web3\Cli\Contracts\Command $command */
            $command = new $command();

            $reflection = new ReflectionClass($command);
            $name = strtolower($reflection->getShortName());

            $instance = new Command($name);

            $command->configure($instance);

            return $instance->setCode(fn () => $command->run(...func_get_args()));
        }, $commands);
    }
}
