<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

interface ThemeRegistryInterface
{
    /**
     * Sets a theme identify by a alias.
     *
     * @param string         $alias  The alias.
     * @param ThemeInterface $theme  The theme.
     *
     * @return ThemeRegistryInterface
     */
    public function setTheme($alias, ThemeInterface $theme);

    /**
     * Returns a theme by alias.
     *
     * @param string $alias The alias of the theme.
     *
     * @return ThemeRegistryInterface.
     *
     * @throws Exception\UnexpectedTypeException  if the passed alias is not a string.
     * @throws Exception\InvalidArgumentException if the theme can not be retrieved.
     */
    public function getTheme($alias);

    /**
     * Returns whether the given theme is supported.
     *
     * @param string $alias The alias of the theme.
     *
     * @return bool Whether the theme is supported.
     */
    public function hasTheme($alias);
}
