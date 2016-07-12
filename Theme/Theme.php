<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Theme;

class Theme implements ThemeInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $rules;

    /**
     * Constructor
     */
    public function __construct($alias, $path, array $rules = array())
    {
        $this->alias = $alias;
        $this->path  = $path;
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules()
    {
        return $this->rules;
    }
}