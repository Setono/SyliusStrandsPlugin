<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\TagBagBundle\Factory\TwigTagFactory;
use Setono\TagBagBundle\HttpFoundation\Session\Tag\TagBagInterface;
use Setono\TagBagBundle\Tag\TagInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ItemsPurchasedSubscriber extends TagSubscriber
{
    /**
     * @var TwigTagFactory
     */
    private $twigTagFactory;

    public function __construct(TagBagInterface $tagBag, TwigTagFactory $twigTagFactory)
    {
        parent::__construct($tagBag);

        $this->twigTagFactory = $twigTagFactory;
    }

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

        $tag = $this->twigTagFactory->create('@SetonoSyliusStrandsPlugin/Tag/items_purchased.js.twig', TagInterface::TYPE_SCRIPT, [
            'order' => $order,
        ]);

        $this->tagBag->addScript($tag, TagBagInterface::SECTION_BODY_BEGIN);
    }
}
