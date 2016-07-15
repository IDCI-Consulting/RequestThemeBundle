<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

use Symfony\Component\HttpFoundation\Request;

class RuleAssessorManager
{
    /**
     * @var RuleAssessorRegistryInterface
     */
    private $registry;

    /**
     * Constructor.
     *
     * @param RuleAssessorRegistryInterface $registry
     */
    public function __construct(RuleAssessorRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Match parameters.
     *
     * @param string  $alias      The rule alias.
     * @param Request $request    The http request.
     * @param array   $parameters The parameters to fit.
     *
     * @return boolean True if parameters fit the rule, false otherwise.
     */
    public function match($alias, Request $request, array $parameters = array())
    {
        $ruleAssessor = $this->registry->getRuleAssessor($alias);

        return $ruleAssessor->match($request, $parameters);
    }
}