<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

interface ThemeInterface
{
    const TEMPLATE_NAMESPACE = "theme";

    /**
     * Returns the theme name.
     *
     * @return string
     */
    public function getName();

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

    /**
     * Returns the template path
     *
     * @param string
     */
    public function getTemplatePath();

    /**
     * Returns the public path
     *
     * @param string
     */
    public function getPublicPath();
}