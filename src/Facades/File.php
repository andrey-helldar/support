<?php

namespace Helldar\Support\Facades;

class File
{
    public static function all(string $path): array
    {
        $files = [];

        foreach (Directory::all($path) as $iterator) {
            if ($iterator->isFile()) {
                $files[] = $files;
            }
        }

        return $files;
    }

    public static function store(string $path, string $content)
    {
        Directory::make(pathinfo($path, PATHINFO_DIRNAME));

        file_put_contents($path, $content);
    }

    /**
     * @deprecated Use Helldar\Support\Facades\Directory::make() instead.
     *
     * @param  string  $path
     *
     * @return bool
     */
    public static function makeDirectory(string $path): bool
    {
        return Directory::make($path);
    }
}