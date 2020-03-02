<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use Setono\SyliusStrandsPlugin\Resolver\ItemCodeResolverInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class ItemCodeExtension extends AbstractExtension
{
    /** @var ItemCodeResolverInterface */
    private $itemCodeResolver;

    public function __construct(ItemCodeResolverInterface $itemCodeResolver)
    {
        $this->itemCodeResolver = $itemCodeResolver;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('setono_sylius_strands_item_code', [$this, 'itemCode'], ['is_safe' => ['html']]),
        ];
    }

    public function itemCode(OrderItemInterface $item): string
    {
        return $this->itemCodeResolver->resolve($item);
    }
}
