<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Tag;

final class Tags
{
    public const TAG_LIBRARY = 'setono_sylius_strands_library';

    public const TAG_EVENT_HANDLER = 'setono_sylius_strands_event_handler';

    public const TAG_ITEMS_PURCHASED = 'setono_sylius_strands_items_purchased';

    public const TAG_ITEM_VISITED = 'setono_sylius_strands_item_visited';

    public const TAG_SHOPPING_CART_UPDATED = 'setono_sylius_strands_shopping_cart_updated';

    private function __construct()
    {
    }
}
