<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class WidgetExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('strands_add_item', [Runtime::class, 'addItem'], ['is_safe' => ['html']]),
            new TwigFilter('strands_add_items', [Runtime::class, 'addItems'], ['is_safe' => ['html']]),
            new TwigFilter('strands_add_cart_items', [Runtime::class, 'addCartItems'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('strands_widget', [Runtime::class, 'widget'], ['is_safe' => ['html']]),
        ];
    }
}
