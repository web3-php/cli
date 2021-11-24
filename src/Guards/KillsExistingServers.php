<?php

declare(strict_types=1);

namespace Web3\Cli\Guards;

use Web3\Cli\Contracts\Guard;
use Web3\Cli\Support\DB;

/**
 * @internal
 */
final class KillsExistingServers implements Guard
{
    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        if (is_string($processId = DB::get('server'))) {
            return;
        }

        @posix_kill((int) $processId, SIGQUIT);

        DB::set('server', null);

        sleep(1);
    }
}
