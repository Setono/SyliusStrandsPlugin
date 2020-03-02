<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class ItemCodeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('strands_item_code', [Runtime::class, 'itemCode'], ['is_safe' => ['html']]),
        ];
    }
}
