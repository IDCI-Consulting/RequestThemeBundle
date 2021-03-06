<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use IDCI\Bundle\RequestThemeBundle\DependencyInjection\Compiler\ThemeCompilerPass;
use IDCI\Bundle\RequestThemeBundle\DependencyInjection\Compiler\RuleAssessorCompilerPass;

class IDCIRequestThemeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ThemeCompilerPass());
        $container->addCompilerPass(new RuleAssessorCompilerPass());
    }
}