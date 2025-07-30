<?php

namespace App\Service\Contract;

interface ModuleContentInterface
{
    public function getName(): string;

    public function getStyles(): array;

    public function getScripts(): array;

    /**
     * Возвращает содержимое для текущего маршрута и позиции.
     * Может быть строкой (HTML) или массивом (например, данных для шаблона).
     */
    public function getContent(string $route, string $position): ?string;
}
