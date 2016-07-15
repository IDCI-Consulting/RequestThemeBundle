<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

use IDCI\Bundle\RequestThemeBundle\Exception\UnexpectedTypeException;

class RuleAssessorRegistry implements RuleAssessorRegistryInterface
{
    /**
     * @var RuleAssessorInterface[]
     */
    private $ruleAssessors = array();

    /**
     * {@inheritdoc}
     */
    public function setRuleAssessor($alias, RuleAssessorInterface $ruleAssessor)
    {
        $this->ruleAssessors[$alias] = $ruleAssessor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRuleAssessor($alias)
    {
        if (!is_string($alias)) {
            throw new UnexpectedTypeException($alias, 'string');
        }

        if (!isset($this->ruleAssessors[$alias])) {
            throw new \InvalidArgumentException(sprintf('Could not load rule assessor "%s"', $alias));
        }

        return $this->ruleAssessors[$alias];
    }

    /**
     * {@inheritdoc}
     */
    public function hasRuleAssessor($alias)
    {
        if (!isset($this->ruleAssessors[$alias])) {
            return false;
        }

        return true;
    }
}