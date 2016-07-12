<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

interface ThemeInterface
{
    /**
     * Returns the theme alias.
     *
     * @return string
     */
    public function getAlias();

    /**
     * Returns the theme files path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Returns the rules.
     *
     * @return array
     */
    public function getRules();
}