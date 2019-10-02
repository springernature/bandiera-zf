<?php
declare(strict_types=1);

namespace SpringerNature\Zend\Bandiera\Test\Integration;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * This is the doctrine way of booting a service manager for V3
 *
 * @author roberto
 */
class ServiceManagerFactory
{
    /**
     * @return array
     */
    public static function getConfiguration()
    {
        $configFile = 'TestConfigurationV3.php';

        return include __DIR__ . '/' . $configFile;
    }

    /**
     * Retrieves a new ServiceManager instance
     *
     * @param  array|null $configuration
     * @return ServiceManager
     */
    public static function getServiceManager(array $configuration = null)
    {
        $configuration = $configuration ?: static::getConfiguration();
        $serviceManager = new ServiceManager();
        $serviceManagerConfig = new ServiceManagerConfig(
            isset($configuration['service_manager']) ? $configuration['service_manager'] : []
        );
        $serviceManagerConfig->configureServiceManager($serviceManager);

        $serviceManager->setService('ApplicationConfig', $configuration);

        if ( ! $serviceManager->has('ServiceListener')) {
            $serviceManager->setFactory('ServiceListener', 'Zend\Mvc\Service\ServiceListenerFactory');
        }

        /* @var $moduleManager \Zend\ModuleManager\ModuleManagerInterface */
        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();

        return $serviceManager;
    }
}
