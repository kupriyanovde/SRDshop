<?php
namespace App\Service;

use App\Repository\Layout\LayoutModuleRepository;
use App\Service\Contract\ModuleContentInterface;

class ModuleContentBuilder
{
    public function __construct(
        /**
         * @param iterable<ModuleContentInterface> $modules
         */
        private iterable $modules,
        private LayoutModuleRepository $layoutRepository
    ) {}

    /**
     * Собирает модули и возвращает HTML + массивы стилей и скриптов
     *
     * @return array{
     *     html: string[],
     *     styles: string[],
     *     scripts: string[]
     * }
     */
    public function build(string $route, string $position): array
    {
        $items = $this->layoutRepository->findByRouteAndPosition($route, $position);

        $result = [
            'html' => [],
            'styles' => [],
            'scripts' => [],
        ];

        foreach ($items as $item) {
            $needModuleName = $item->getName();

            foreach ($this->modules as $module) {
                if ($module->getName() === $needModuleName) {
                    $result['html'][] = $module->getContent($route, $position);

                    $result['styles'] = array_merge($result['styles'], $module->getStyles());
                    $result['scripts'] = array_merge($result['scripts'], $module->getScripts());

                    // Прервать внутренний цикл, раз модуль найден
                    break;
                }
            }
        }

        // Удаляем дубликаты
        $result['styles'] = array_unique($result['styles']);
        $result['scripts'] = array_unique($result['scripts']);

        return $result;
    }
}
