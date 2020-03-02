# Sylius Strands Plugin

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Quality Score][ico-code-quality]][link-code-quality]

Integrates the [Strands recommendation engine](https://retail.strands.com/products/product-recommendations/) into Sylius. 

## Installation

### Step 1: Download the plugin

Open a command console, enter your project directory and execute the following command to download the latest stable version of this plugin:

```bash
# Omit setono/sylius-tag-bag-plugin if you want to
# override layout.html.twig as described at https://github.com/Setono/TagBagBundle#usage
$ composer require setono/sylius-strands-plugin setono/sylius-tag-bag-plugin
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Step 2: Enable the plugin

Then, enable the plugin by adding it to the list of registered plugins/bundles
in the `config/bundles.php` file of your project:

```php
<?php
# config/bundles.php
return [
    Setono\TagBagBundle\SetonoTagBagBundle::class => ['all' => true],

    // Use this bundle or override layout.html.twig as described at https://github.com/Setono/TagBagBundle#usage
    Setono\SyliusTagBagPlugin\SetonoSyliusTagBagPlugin::class => ['all' => true],

    Setono\SyliusStrandsPlugin\SetonoSyliusStrandsPlugin::class => ['all' => true],
];
```

### Step 3: Create configuration 

```bash
# config/packages/setono_sylius_strands.yaml
setono_sylius_strands:
    api_id: "%env(STRANDS_API_ID)%"
```

```
# .env

# Get it at https://retail.strands.com/account/info/
STRANDS_API_ID=YOUR_API_ID
```

[ico-version]: https://poser.pugx.org/setono/sylius-strands-plugin/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/sylius-strands-plugin/v/unstable
[ico-license]: https://poser.pugx.org/setono/sylius-strands-plugin/license
[ico-github-actions]: https://github.com/Setono/SyliusStrandsPlugin/workflows/build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/SyliusStrandsPlugin.svg

[link-packagist]: https://packagist.org/packages/setono/sylius-strands-plugin
[link-github-actions]: https://github.com/Setono/SyliusStrandsPlugin/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/SyliusStrandsPlugin
