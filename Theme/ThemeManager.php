<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

use Symfony\Component\HttpFoundation\Request;
use IDCI\Bundle\RequestThemeBundle\Exception\UnexpectedTypeException;
use IDCI\Bundle\RequestThemeBundle\RuleAssessor\RuleAssessorManager;

class ThemeManager
{
    /**
     * @var ThemeRegistryInterface
     */
    private $registry;

    /**
     * @var RuleAssessorManager
     */
    private $ruleAssessorManager;

    /**
     * Constructor
     *
     * @param ThemeRegistryInterface $registry
     * @param RuleAssessorManager    $ruleAssessorManager
     */
    public function __construct(
        ThemeRegistryInterface $registry,
        RuleAssessorManager    $ruleAssessorManager
    )
    {
        $this->registry            = $registry;
        $this->ruleAssessorManager = $ruleAssessorManager;
    }

    /**
     * Returns full theme template path
     *
     * @param string $path
     */
    public static function getTemplate($path)
    {
        if (!is_string($path)) {
            throw new UnexpectedTypeException($path, 'string');
        }

        return sprintf(
            '@%s/%s',
            ThemeInterface::TEMPLATE_NAMESPACE,
            $path
        );
    }

    /**
     * Returns full theme asset path
     *
     * @param string $path
     */
    public static function getAsset($path)
    {
        if (!is_string($path)) {
            throw new UnexpectedTypeException($path, 'string');
        }

        return $path;
    }

    /**
     * Guess a theme based on a Request
     *
     * @param Request $request.
     *
     * @return ThemeInterface | null
     */
    public function guessTheme(Request $request)
    {
        foreach ($this->registry->getThemes() as $theme) {
            if ($this->match($theme, $request)) {
                return $theme;
            }
        }

        return null;
    }

    /**
     * Match theme rules with the request.
     *
     * @param ThemeInterface $theme
     * @param Request $request
     *
     * @return boolean
     */
    public function match(ThemeInterface $theme, Request $request)
    {
        foreach ($theme->getRules() as $rule) {
            foreach ($rule as $alias => $parameters) {
                if (!$this->ruleAssessorManager->match($alias, $request, $parameters)) {
                    return false;
                }
            }
        }

        return true;
    }
}