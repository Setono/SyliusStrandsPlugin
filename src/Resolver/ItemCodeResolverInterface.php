<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Resolver;

use Sylius\Component\Core\Model\OrderItemInterface;

interface ItemCodeResolverInterface
{
    /**
     * Will resolve the items code based on the plugin configuration
     *
     * @param OrderItemInterface $item
     *
     * @return string
     */
    public function resolve(OrderItemInterface $item): string;
}
