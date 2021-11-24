<?php

declare(strict_types=1);

namespace Web3\Cli\Factories;

use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Web3\Cli\Exceptions\FriendlyConsoleException;
use Web3\Cli\Kernel;
use Web3\Cli\Support\View;

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

            return $instance->setCode(function (InputInterface $input, OutputInterface $output) use ($command) {
                foreach ($command->guards() as $guard) {
                    try {
                        (new $guard())->execute();
                    } catch (FriendlyConsoleException $e) {
                        View::error($e->getTitle(), $e->getDescription());

                        Kernel::shutdown();
                    }
                }

                $command->run($input, $output);
            });
        }, $commands);
    }
}
