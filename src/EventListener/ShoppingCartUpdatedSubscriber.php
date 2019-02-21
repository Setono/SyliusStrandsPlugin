<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Resolver\ItemCodeResolverInterface;
use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBagBundle\Tag\ScriptTag;
use Setono\TagBagBundle\TagBag\TagBagInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Context\CartContextInterface;

final class ShoppingCartUpdatedSubscriber extends TagSubscriber
{
    /**
     * @var CartContextInterface
     */
    private $cartContext;

    /**
     * @var ItemCodeResolverInterface
     */
    private $itemCodeResolver;

    public function __construct(TagBagInterface $tagBag, CartContextInterface $cartContext, ItemCodeResolverInterface $itemCodeResolver)
    {
        parent::__construct($tagBag);

        $this->cartContext = $cartContext;
        $this->itemCodeResolver = $itemCodeResolver;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.order_item.post_add' => [
                'addScript',
            ],
            'sylius.order_item.post_remove' => [
                'addScript',
            ],
            'sylius.order.post_update' => [
                'addScript',
            ],
        ];
    }

    public function addScript(): void
    {
        $cart = $this->cartContext->getCart();

        if (!$cart instanceof OrderInterface) {
            return;
        }

        $codes = [];

        foreach ($cart->getItems() as $item) {
            $code = $this->itemCodeResolver->resolve($item);
            if ('' === $code) {
                continue;
            }

            $codes[] = $code;
        }

        $codeString = '';
        if (\count($codes)) {
            $codeString = '"' . implode('", "', $codes) . '"';
        }

        $this->tagBag->add(new ScriptTag(sprintf('StrandsTrack.push({ event:"updateshoppingcart", items: [%s]})', $codeString), Tags::TAG_SHOPPING_CART_UPDATED), TagBagInterface::SECTION_BODY_BEGIN);
    }
}
