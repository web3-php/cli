<?php

declare(strict_types=1);

namespace Web3\Cli\Repositories;

use Web3\Cli\Support\DB;

/**
 * @internal
 */
final class Servers
{
    public static function ensureNotRunning(): void
    {
        if (is_string(DB::get('server'))) {
            self::terminate();
        }
    }

    public static function terminate(): void
    {
        $processId = DB::get('server');

        posix_kill((int) $processId, SIGQUIT);

        DB::set('server', null);
    }
}
