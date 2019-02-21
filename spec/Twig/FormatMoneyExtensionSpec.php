<?php

namespace spec\Setono\SyliusStrandsPlugin\Twig;

use Setono\SyliusStrandsPlugin\Twig\FormatMoneyExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormatMoneyExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(FormatMoneyExtension::class);
    }

    public function it_formats(): void
    {
        $tests = [
            1 => '0.01',
            100 => '1.00',
            101 => '1.01',
            200 => '2.00',
        ];

        foreach ($tests as $input => $expected) {
            $this->formatMoney($input)->shouldReturn($expected);
        }
    }
}
