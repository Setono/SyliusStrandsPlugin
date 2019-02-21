<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBagBundle\Tag\TagInterface;
use Setono\TagBagBundle\Tag\TwigTag;
use Setono\TagBagBundle\TagBag\TagBagInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Product\Model\ProductInterface;

final class ItemVisitedSubscriber extends TagSubscriber
{
    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.product.show' => [
                'addScript',
            ],
        ];
    }

    public function addScript(ResourceControllerEvent $event): void
    {
        $product = $event->getSubject();

        if (!$product instanceof ProductInterface) {
            return;
        }

        $this->tagBag->add(new TwigTag(
            '@SetonoSyliusStrandsPlugin/Tag/item_visited.js.twig',
            TagInterface::TYPE_SCRIPT,
            Tags::TAG_ITEM_VISITED,
            ['product' => $product]
        ), TagBagInterface::SECTION_BODY_BEGIN);
    }
}
