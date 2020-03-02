<?php

declare(strict_types=1);

namespace Setono\SyliusStrandsPlugin\Widget;

/**
 * This class represents a Strands widget: http://retail.strands.com/resources/javascript-library/#widinstall
 */
final class Widget
{
    /** @var string */
    private $template;

    /** @var string[] */
    private $items = [];

    /** @var string[][] */
    private $filters = [];

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public static function create(string $template): self
    {
        return new self($template);
    }

    public function getHtml(): string
    {
        $html = '<div class="strandsRecs" tpl="' . $this->template . '"';

        if (count($this->items) > 0) {
            $html .= ' item="' . implode('_._', $this->items) . '"';
        }

        $filterString = $this->getFilterString();
        if (null !== $filterString) {
            $html .= ' dfilter="' . $filterString . '"';
        }

        $html .= '></div>';

        return $html;
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }

    public function addItem(string $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param string $key The property to filter on, i.e. Category
     * @param string $value The value to filter, i.e. Shoes
     */
    public function addFilter(string $key, string $value): self
    {
        $this->filters[$key][] = $value;

        return $this;
    }

    private function getFilterString(): ?string
    {
        if (count($this->filters) === 0) {
            return null;
        }

        $filterGroups = [];

        foreach ($this->filters as $key => $val) {
            $filterGroups[] = $key . '::' . implode(';;', $val);
        }

        return implode('_._', $filterGroups);
    }
}
