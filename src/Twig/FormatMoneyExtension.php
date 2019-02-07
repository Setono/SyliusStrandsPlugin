<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class FormatMoneyExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('setono_sylius_strands_format_money', [$this, 'formatMoney']),
        ];
    }

    public function formatMoney(int $money): string
    {
        return (string) round($money / 100, 2);
    }
}
