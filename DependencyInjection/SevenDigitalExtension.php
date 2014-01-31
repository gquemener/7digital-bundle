<?php

namespace SevenDigital\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

class SevenDigitalExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($config, $container);
        $config = $this->processConfiguration($configuration, $config);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $clientDef = $container->findDefinition('7digital_api.client');
        $clientDef->setArguments(array(
            $config['consumer_key'],
            $config['cache'] ? new Reference($config['cache']) : null,
            $config['version']
        ));

        $this->registerApiService($container, 'track');
        $this->registerApiService($container, 'artist');
        $this->registerApiService($container, 'release');
        $this->registerApiService($container, 'tag');
    }

    private function registerApiService(ContainerBuilder $container, $alias)
    {
        $container->register(sprintf('7digital_api.%s', $alias), sprintf('SevenDigital\Service\%s', ucfirst($alias)))
            ->setFactoryService('7digital_api_client')
            ->setFactoryMethod(sprintf('get%sService', ucfirst($alias)));
    }
}
