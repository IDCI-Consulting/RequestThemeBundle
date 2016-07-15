<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

interface RuleAssessorRegistryInterface
{
    /**
     * Sets a rule assessor identify by a alias.
     *
     * @param string                $alias        The alias.
     * @param RuleAssessorInterface $ruleAssessor The rule assessor.
     *
     * @return RuleAssessorRegistryInterface
     */
    public function setRuleAssessor($alias, RuleAssessorInterface $ruleAssessor);

    /**
     * Returns a rule assessor by alias.
     *
     * @param string $alias The alias of the rule assessor.
     *
     * @return RuleAssessorRegistryInterface.
     *
     * @throws Exception\UnexpectedTypeException  if the passed alias is not a string.
     * @throws Exception\InvalidArgumentException if the rule assessor can not be retrieved.
     */
    public function getRuleAssessor($alias);

    /**
     * Returns whether the given rule assessor is supported.
     *
     * @param string $alias The alias of the rule assessor.
     *
     * @return bool Whether the rule assessor is supported.
     */
    public function hasRuleAssessor($alias);
}