<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusStrandsPlugin\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\SyliusStrandsPlugin\DependencyInjection\SetonoSyliusStrandsExtension;

final class SetonoSyliusStrandsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new SetonoSyliusStrandsExtension()];
    }

    protected function getMinimalConfiguration(): array
    {
        return [
            'api_id' => 'test_api_id',
        ];
    }

    /**
     * @test
     */
    public function after_loading_the_correct_parameters_has_been_set(): void
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('setono_sylius_strands.api_id', 'test_api_id');
    }
}
