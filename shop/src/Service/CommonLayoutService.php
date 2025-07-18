<?php

namespace App\Service;

use App\Service\Contract\CommonLayoutContentInterface;

class CommonLayoutService
{
    /**
     * @param iterable<CommonLayoutContentInterface> $components
     */
    private array $parts;

    public function __construct(iterable $parts)
    {
        foreach ($parts as $part) {
            $this->parts[$part->getKey()] = $part;
        }
    }

    public function getLayoutParts(): array
    {
        $layout = [];
        foreach ($this->parts as $key => $part) {
            $layout[$key] = $part->render();
        }

        return $layout;
    }
}
