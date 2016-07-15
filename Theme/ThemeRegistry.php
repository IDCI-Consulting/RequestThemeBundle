<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

use IDCI\Bundle\RequestThemeBundle\Exception\UnexpectedTypeException;

class ThemeRegistry implements ThemeRegistryInterface
{
    /**
     * @var ThemeInterface[]
     */
    private $themes = array();

    /**
     * {@inheritdoc}
     */
    public function setTheme($alias, ThemeInterface $theme)
    {
        $this->themes[$alias] = $theme;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTheme($alias)
    {
        if (!is_string($alias)) {
            throw new UnexpectedTypeException($alias, 'string');
        }

        if (!isset($this->themes[$alias])) {
            throw new \InvalidArgumentException(sprintf('Could not load theme "%s"', $alias));
        }

        return $this->themes[$alias];
    }

    /**
     * {@inheritdoc}
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * {@inheritdoc}
     */
    public function hasTheme($alias)
    {
        if (!isset($this->themes[$alias])) {
            return false;
        }

        return true;
    }
}