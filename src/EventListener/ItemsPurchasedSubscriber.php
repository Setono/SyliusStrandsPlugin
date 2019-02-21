<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBagBundle\Tag\TwigTag;
use Setono\TagBagBundle\TagBag\TagBagInterface;
use Setono\TagBagBundle\Tag\TagInterface;
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

        $this->tagBag->add(new TwigTag(
            '@SetonoSyliusStrandsPlugin/Tag/items_purchased.js.twig',
            TagInterface::TYPE_SCRIPT,
            Tags::TAG_ITEMS_PURCHASED,
            ['order' => $order]
        ), TagBagInterface::SECTION_BODY_BEGIN);
    }
}
