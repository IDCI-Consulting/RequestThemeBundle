<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

abstract class AbstractRuleAssessor implements RuleAssessorInterface
{
    /**
     * Do match the rule using parameters
     *
     * @param Request $request    The http request.
     * @param array   $parameters The parameters to match.
     *
     * @return boolean True if the given parameters fit, false otherwise.
     */
    abstract public function doMatch(Request $request, array $parameters = array());

    /**
     * Set default parameters
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultParameters(OptionsResolverInterface $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function match(Request $request, array $parameters = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultParameters($resolver);
        $resolvedParameters = $resolver->resolve($parameters);

        return $this->doMatch($request, $resolvedParameters);
    }
}