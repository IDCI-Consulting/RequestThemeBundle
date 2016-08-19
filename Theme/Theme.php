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
    public function __construct($name, $alias = null, $path, array $rules = array())
    {
        $this->name  = $name;
        $this->alias = $alias;
        $this->path  = $path;
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        if (null === $this->alias) {
            return $this->getName();
        }

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

    /**
     * {@inheritdoc}
     */
    public function getTemplatePath()
    {
        return sprintf('%s/views', $this->getPath());
    }

    /**
     * {@inheritdoc}
     */
    public function getPublicPath()
    {
        return sprintf('%s/public', $this->getPath());
    }
}