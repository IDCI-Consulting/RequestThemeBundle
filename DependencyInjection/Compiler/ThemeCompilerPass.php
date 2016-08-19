<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class ThemeCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('idci_request_theme.theme_registry') ||
            !$container->hasDefinition('idci_request_theme.theme')
        ) {
            return;
        }

        $registryDefinition = $container->getDefinition('idci_request_theme.theme_registry');
        $configuration = $container->getParameter('idci_request_theme.configuration');

        foreach ($configuration['themes'] as $name => $themeConfiguration) {
            $serviceDefinition = new DefinitionDecorator('idci_request_theme.theme');
            $serviceName = sprintf('idci_request_theme.theme.%s', $name);

            $serviceDefinition->isAbstract(false);
            $serviceDefinition->replaceArgument(0, $name);
            $serviceDefinition->replaceArgument(1, $themeConfiguration['alias']);
            $serviceDefinition->replaceArgument(2, $themeConfiguration['path']);
            $serviceDefinition->replaceArgument(3, $themeConfiguration['rules']);

            $container->setDefinition($serviceName, $serviceDefinition);

            $registryDefinition->addMethodCall(
                'setTheme',
                array($name, new Reference($serviceName))
            );
        }
    }
}