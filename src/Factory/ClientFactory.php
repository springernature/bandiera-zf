<?php
declare(strict_types=1);

namespace SpringerNature\Zend\Bandiera\Factory;


use Interop\Container\ContainerInterface;
use Nature\Bandiera\Client;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ClientFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Client
    {
        $config = $container->get('Config');

        if (false === \array_key_exists('springernature_bandiera', $config)
            || false === isset($config['springernature_bandiera']['url'])) {
            throw new ServiceNotCreatedException(
                'Configuration missing [springernature_bandiera][url]'
            );
        }

        return new Client($config['springernature_bandiera']['url']);
    }
}
