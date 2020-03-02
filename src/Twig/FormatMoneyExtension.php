<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Twig;

use function Safe\sprintf;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class FormatMoneyExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('strands_format_money', [$this, 'formatMoney']),
        ];
    }

    public function formatMoney(int $money): string
    {
        return sprintf('%01.2F', $money / 100);
    }
}
