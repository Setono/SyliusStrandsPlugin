<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusStrandsPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\PageInterface;

interface WelcomePageInterface extends PageInterface
{
    /**
     * @return string
     */
    public function getGreeting(): string;
}
