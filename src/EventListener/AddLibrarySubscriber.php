<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\SyliusStrandsPlugin\Tag\Tags;
use Setono\TagBag\Tag\ScriptTag;
use Setono\TagBag\Tag\TagInterface;
use Setono\TagBag\Tag\TwigTag;
use Setono\TagBag\TagBagInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class AddLibrarySubscriber extends TagSubscriber
{
    /** @var string */
    private $apiId;

    public function __construct(TagBagInterface $tagBag, string $apiId)
    {
        parent::__construct($tagBag);

        $this->apiId = $apiId;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [
                'addLibrary',
            ],
        ];
    }

    public function addLibrary(GetResponseEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // Only add the library on 'real' page loads, not AJAX requests like add to cart
        if ($event->getRequest()->isXmlHttpRequest()) {
            return;
        }

        $this->tagBag->addTag(
            (new ScriptTag('var StrandsTrack = window.StrandsTrack || [];'))
                ->setSection(TagInterface::SECTION_HEAD)
        );
        $this->tagBag->addTag(
            (new TwigTag('@SetonoSyliusStrandsPlugin/Tag/library.html.twig', ['api_id' => $this->apiId]))
                ->setSection(TagInterface::SECTION_BODY_BEGIN)
                ->setName(Tags::TAG_LIBRARY)
        );
    }
}
