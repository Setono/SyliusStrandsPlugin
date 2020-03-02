<?php
declare(strict_types=1);

namespace Tests\Setono\SyliusStrandsPlugin\Widget;

use PHPUnit\Framework\TestCase;
use Setono\SyliusStrandsPlugin\Widget\Widget;

final class WidgetTest extends TestCase
{
    /**
     * @test
     */
    public function generic_widget(): void
    {
        $widget = Widget::create('tpl-1');

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1"></div>', $widget->getHtml());
    }

    /**
     * @test
     */
    public function item_widget(): void
    {
        $widget = Widget::create('tpl-1')
            ->addItem('item-1')
        ;

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1" item="item-1"></div>', $widget->getHtml());
    }

    /**
     * @test
     */
    public function items_widget(): void
    {
        $widget = Widget::create('tpl-1')
            ->addItem('item-1')
            ->addItem('item-2')
        ;

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1" item="item-1_._item-2"></div>', $widget->getHtml());
    }

    /**
     * @test
     */
    public function filter_widget(): void
    {
        $widget = Widget::create('tpl-1')
            ->addFilter('category', 'shoes')
        ;

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1" dfilter="category::shoes"></div>', $widget->getHtml());
    }

    /**
     * @test
     */
    public function filters_widget(): void
    {
        $widget = Widget::create('tpl-1')
            ->addFilter('category', 'shoes')
            ->addFilter('gender', 'men')
        ;

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1" dfilter="category::shoes_._gender::men"></div>', $widget->getHtml());
    }

    /**
     * @test
     */
    public function filters_with_multiple_values_widget(): void
    {
        $widget = Widget::create('tpl-1')
            ->addFilter('category', 'shoes')
            ->addFilter('category', 'jeans')
            ->addFilter('gender', 'men')
        ;

        $this->assertSame('<div class="strandsRecs" tpl="tpl-1" dfilter="category::shoes;;jeans_._gender::men"></div>', $widget->getHtml());
    }
}
