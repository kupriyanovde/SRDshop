<?php

namespace App\Service\Contract;

interface ModuleContentInterface
{
    public function getName(): string;

    /**
     * Возвращает содержимое для текущего маршрута и позиции.
     * Может быть строкой (HTML) или массивом (например, данных для шаблона).
     */
    public function getContent(string $route, string $position): ?string;
}
