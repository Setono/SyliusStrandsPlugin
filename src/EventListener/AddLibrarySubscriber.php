<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\EventListener;

use Setono\TagBagBundle\HttpFoundation\Session\Tag\TagBagInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class AddLibrarySubscriber extends TagSubscriber
{
    /**
     * @var string
     */
    private $apiId;

    public function __construct(TagBagInterface $tagBag, string $apiId)
    {
        parent::__construct($tagBag);

        $this->apiId = $apiId;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => [
                'addLibrary',
            ],
        ];
    }

    public function addLibrary(FilterResponseEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // Only add the library on 'real' page loads, not AJAX requests like add to cart
        if ($event->getRequest()->isXmlHttpRequest()) {
            return;
        }

        // we don't want to add the library code on redirects
        $statusCode = $event->getResponse()->getStatusCode();
        if (($statusCode < 200 || $statusCode > 299) && !in_array($statusCode, [404, 500], true)) {
            return;
        }

        $this->tagBag->addScript('window.StrandsTrack = window.StrandsTrack || [];', TagBagInterface::SECTION_HEAD);
        $this->tagBag->add(sprintf('<script src="https://bizsolutions.strands.com/sbsstatic/js/sbsLib-1.0.min.js"></script><script>try{SBS.Worker.go("%s");} catch (e){};</script>', $this->apiId), TagBagInterface::SECTION_BODY_END);
    }
}
