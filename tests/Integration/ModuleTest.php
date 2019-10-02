<?php
declare(strict_types=1);

namespace SpringerNature\Zend\Bandiera\Test\Integration;


use Nature\Bandiera\Client;
use PHPUnit\Framework\TestCase;
use SpringerNature\Zend\Bandiera\View\Helper\FeatureFlags;

class ModuleTest extends TestCase
{
    /** @test */
    public function it_registers_bandiera_client_instance(): void
    {
        $this->assertInstanceOf(
            Client::class,
            ServiceManagerFactory::getServiceManager()->get(Client::class)
        );
    }

    /** @test */
    public function it_registers_bandiera_alias(): void
    {
        $this->assertInstanceOf(
            Client::class,
            ServiceManagerFactory::getServiceManager()->get('springernature.bandiera.client')
        );
    }

    /** @test */
    public function it_registers_featureFlags_view_helper(): void
    {
        $viewHelperManager = ServiceManagerFactory::getServiceManager()->get('ViewHelperManager');

        $this->assertInstanceOf(
            FeatureFlags::class,
            $viewHelperManager->get('featureFlags')
        );
    }
}
