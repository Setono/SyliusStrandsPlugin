<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use Setono\SyliusStrandsPlugin\Resolver\ItemCodeResolverInterface;
use Setono\SyliusStrandsPlugin\Widget\Widget;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Order\Context\CartContextInterface;
use Twig\Extension\RuntimeExtensionInterface;

final class Runtime implements RuntimeExtensionInterface
{
    /** @var ItemCodeResolverInterface */
    private $itemCodeResolver;

    /** @var CartContextInterface */
    private $cartContext;

    public function __construct(ItemCodeResolverInterface $itemCodeResolver, CartContextInterface $cartContext)
    {
        $this->itemCodeResolver = $itemCodeResolver;
        $this->cartContext = $cartContext;
    }

    public function itemCode(OrderItemInterface $item): string
    {
        return $this->itemCodeResolver->resolve($item);
    }

    public function widget(string $template): Widget
    {
        return new Widget($template);
    }

    public function addItems(Widget $widget, iterable $items): Widget
    {
        foreach ($items as $item) {
            if ($item instanceof OrderItemInterface) {
                $widget->addItem($this->itemCodeResolver->resolve($item));
            } else {
                $widget->addItem($item);
            }
        }

        return $widget;
    }

    public function addCartItems(Widget $widget): Widget
    {
        $cart = $this->cartContext->getCart();

        if (count($cart->getItems()) === 0) {
            return $widget;
        }

        return $this->addItems($widget, $cart->getItems());
    }
}
