<?php

declare(strict_types=1);

namespace Web3\Cli\Support;

use function Termwind\render;
use function Termwind\terminal;

/**
 * @internal
 */
final class View
{
    /**
     * Renders the given View name.
     *
     * @param array<string, array<array-key|mixed>|string> $variables
     */
    public static function render(string $name, array $variables = []): void
    {
        extract($variables);

        ob_start();

        include sprintf(__DIR__ . '/../../resources/views/%s.php', $name);

        $output = (string) ob_get_clean();

        render($output);
    }

    /**
     * Renders the given info label.
     */
    public static function info(string $title, string $description): void
    {
        self::render('alert', [
            'title'       => strtoupper($title),
            'bg'          => 'blue',
            'description' => $description,
        ]);
    }

    /**
     * Returns the terminal width.
     */
    public static function width(): int
    {
        return max(min(terminal()->width() - 500, 0), 50);
    }
}
