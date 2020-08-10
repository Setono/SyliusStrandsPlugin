<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBag\Tag\TagInterface;
use Setono\TagBag\Tag\TwigTag;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ItemsPurchasedSubscriber extends TagSubscriber
{
    public static function getSubscribedEvents(): array
    {
        return [
            'sylius.order.post_complete' => [
                'addScript',
            ],
        ];
    }

    public function addScript(GenericEvent $event): void
    {
        $order = $event->getSubject();

        if (!$order instanceof OrderInterface) {
            return;
        }

        $this->tagBag->addTag(
            (new TwigTag('@SetonoSyliusStrandsPlugin/Tag/items_purchased.js.twig', ['order' => $order]))
                ->setSection(TagInterface::SECTION_BODY_BEGIN)
                ->setName(Tags::TAG_ITEMS_PURCHASED)
        );
    }
}
