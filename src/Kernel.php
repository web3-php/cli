<?php

declare(strict_types=1);

namespace Web3\Cli;

use Symfony\Component\Console\Application;
use Web3\Cli\Support\DB;

/**
 * @internal
 */
final class Kernel
{
    /**
     * The Application name.
     */
    private const NAME = 'Web3';

    /**
     * The Application version.
     */
    private const VERSION = 'v0.0.1';

    /**
     * The current Application instance.
     */
    private static ?Application $application = null;

    /**
     * Boots the Kernel.
     */
    public static function boot(): Application
    {
        DB::boot();

        self::$application = new Application(self::NAME, self::VERSION);

        self::$application->setAutoExit(true);

        return self::$application;
    }

    /**
     * Terminates the Kernel.
     */
    public static function terminate(): void
    {
        self::$application = null;
    }

    /**
     * Terminates the Kernel.
     *
     * @return never
     */
    public static function shutdown(): void
    {
        self::terminate();

        exit(1);
    }
}
