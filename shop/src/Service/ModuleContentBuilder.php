<?php

namespace App\Service;

use App\Repository\LayoutModuleRepository;
use App\Service\Contract\ModuleContentInterface;

class ModuleContentBuilder
{
    public function __construct(
        /**
         * @param iterable<ModuleContentInterface> $modules
         */
        private iterable $modules,
        private LayoutModuleRepository $layoutRepository // репозиторий для БД
    ) {}

    /**
     * @return string[] массив html в нужном порядке
     */
    public function build(string $route, string $position): array
    {
        $items = $this->layoutRepository->findByRouteAndPosition($route, $position); // ['banner6', 'banner1']

        $result = [];

        foreach ($items as $item) {
            $needModuleName = $item->getName();

            foreach ($this->modules as $module) {
                if ($module->getName() === $needModuleName) {
                    $result[] = $module->getContent($route, $position);
                    
                    // Прервать внутренний цикл, раз модуль найден
                    break;
                }
            }
        }

        return $result;
    }
}
