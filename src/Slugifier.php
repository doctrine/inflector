<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Slugifier
{
    /**
     * Convert any passed string to a url friendly string.
     * Converts 'My first blog post' to 'my-first-blog-post'
     *
     * @param  string $string String to urlize.
     *
     * @return string Urlized string.
     */
    public function urlize(string $string): string;
}
