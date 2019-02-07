<?php

namespace spec\Setono\SyliusStrandsPlugin\Resolver;

use Setono\SyliusStrandsPlugin\Resolver\ItemCodeResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

final class ItemCodeResolverSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith(false);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ItemCodeResolver::class);
    }

    public function it_returns_empty_string_when_variant_is_null(OrderItemInterface $item): void
    {
        $this->beConstructedWith(true);
        $item->getVariant()->willReturn(null);

        $this->resolve($item)->shouldReturn('');
    }

    public function it_returns_empty_string_when_product_is_null(OrderItemInterface $item): void
    {
        $this->beConstructedWith(false);
        $item->getProduct()->willReturn(null);

        $this->resolve($item)->shouldReturn('');
    }

    public function it_returns_variant_code_when_variant_based(OrderItemInterface $item, ProductVariantInterface $productVariant): void
    {
        $this->beConstructedWith(true);

        $productVariant->getCode()->willReturn('variant');
        $item->getVariant()->willReturn($productVariant);

        $this->resolve($item)->shouldReturn('variant');
    }

    public function it_returns_product_code_when_not_variant_based(OrderItemInterface $item, ProductInterface $product): void
    {
        $this->beConstructedWith(false);

        $product->getCode()->willReturn('product');
        $item->getProduct()->willReturn($product);

        $this->resolve($item)->shouldReturn('product');
    }
}
