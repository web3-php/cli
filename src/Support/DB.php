<?php

declare(strict_types=1);

namespace Web3\Cli\Support;

/**
 * @internal
 */
final class DB
{
    /**
     * Boots the Database.
     */
    public static function boot(): void
    {
        if (file_exists(self::getLocation()) === false) {
            file_put_contents(self::getLocation(), '{}');
        }
    }

    /**
     * Sets the given Key in the Database.
     */
    public static function set(string $key, ?string $value = null): void
    {
        /** @var array<string, string> $contents */
        $contents = json_decode((string) file_get_contents(self::getLocation()), true);

        $contents[$key] = $value;

        file_put_contents(self::getLocation(), json_encode($contents));
    }

    /**
     * Gets the given Key from the Database.
     */
    public static function get(string $key): string|null
    {
        /** @var array<string, string> $contents */
        $contents = json_decode((string) file_get_contents(self::getLocation()), true);

        return $contents[$key] ?? null;
    }

    /**
     * Flushes the database.
     */
    public static function flush(): void
    {
        if (file_exists(self::getLocation())) {
            @unlink(self::getLocation());
        }
    }

    /**
     * Gets the Database location.
     */
    private static function getLocation(): string
    {
        return __DIR__ . '/../../storage/db.json';
    }
}
