<?php

namespace Innova\MetronomeBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class InnovaMetronomeExtension extends Extension
{  
    
    public function load(array $configs, ContainerBuilder $container) {
        $this->loadParameters($container);
        $this->loadServices($container);

        return $this;
    }

    protected function loadServices(ContainerBuilder $container) {
        $locator = new FileLocator(__DIR__ . '/../Resources/config/services');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('listeners.yml');
        $loader->load('managers.yml');
        $loader->load('form_types.yml');

        return $this;
    }

    protected function loadParameters(ContainerBuilder $container) {
        $locator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load('parameters.yml');
        return $this;
    }
}
