<?php
declare(strict_types=1);

namespace SpringerNature\Zend\Bandiera;

use Nature\Bandiera\Client;
use SpringerNature\Zend\Bandiera\Factory\View\Helper\FeatureFlagsFactory;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements
    ServiceProviderInterface,
    ViewHelperProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return [
            'aliases' => [
                'springernature.bandiera.client' => Client::class,
            ],
            'factories' => [
               Client::class => Factory\ClientFactory::class,
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'featureFlags' => FeatureFlagsFactory::class,
            ]
        ];
    }
}
