<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

use Symfony\Component\HttpFoundation\Request;

interface RuleAssessorInterface
{
    /**
     * Match the rule using parameters
     *
     * @param Request $request    The http request.
     * @param array   $parameters The parameters to match.
     *
     * @return boolean True if the given parameters fit, false otherwise.
     */
    public function match(Request $request, array $parameters = array());
}