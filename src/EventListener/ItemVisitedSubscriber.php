<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBag\Tag\TagInterface;
use Setono\TagBag\Tag\TwigTag;
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

        $this->tagBag->addTag(
            (new TwigTag('@SetonoSyliusStrandsPlugin/Tag/item_visited.js.twig', ['product' => $product]))
                ->setSection(TagInterface::SECTION_BODY_END)
                ->setName(Tags::TAG_ITEM_VISITED)
        );
    }
}
