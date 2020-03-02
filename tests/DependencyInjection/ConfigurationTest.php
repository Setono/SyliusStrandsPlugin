<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusStrandsPlugin\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\SyliusStrandsPlugin\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function values_are_invalid_if_required_value_is_not_provided(): void
    {
        $this->assertConfigurationIsInvalid(
            [
                [], // no values at all
            ],
            'The child node "api_id" at path "setono_sylius_strands" must be configured.'
        );
    }

    /**
     * @test
     */
    public function processed_value_contains_required_value(): void
    {
        $this->assertProcessedConfigurationEquals([
            [
                'api_id' => 'api_id1',
            ],
            [
                'api_id' => 'api_id2',
            ],
        ], [
            'api_id' => 'api_id2',
            'variant_based' => false,
        ]);
    }
}
