<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Resolver;

use Sylius\Component\Core\Model\OrderItemInterface;

final class ItemCodeResolver implements ItemCodeResolverInterface
{
    /** @var bool */
    private $variantBased;

    public function __construct(bool $variantBased)
    {
        $this->variantBased = $variantBased;
    }

    public function resolve(OrderItemInterface $item): string
    {
        if ($this->variantBased) {
            $variant = $item->getVariant();
            if (null === $variant) {
                return '';
            }

            return (string) $variant->getCode();
        }

        $product = $item->getProduct();
        if (null === $product) {
            return '';
        }

        return (string) $product->getCode();
    }
}
