<?php

namespace SpringerNature\Zend\Bandiera\Factory\View\Helper;


use Interop\Container\ContainerInterface;
use Nature\Bandiera\Client;
use SpringerNature\Zend\Bandiera\View\Helper\FeatureFlags;
use Zend\ServiceManager\Factory\FactoryInterface;

class FeatureFlagsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): FeatureFlags
    {
        /** @var Client $client */
        $client = $container->get('springernature.bandiera.client');

        $config = $container->get('Config');
        $group = $config['springernature_bandiera']['group'] ?? '';

        return new FeatureFlags($client, $group);
    }
}
