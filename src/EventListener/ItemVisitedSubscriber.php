<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\TagBagBundle\HttpFoundation\Session\Tag\TagBagInterface;
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

        $this->tagBag->addScript(sprintf('StrandsTrack.push({ event:"visited", item: "%s" });', $product->getCode()), TagBagInterface::SECTION_BODY_BEGIN);
    }
}
