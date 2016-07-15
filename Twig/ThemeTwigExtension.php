<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\Twig;

use IDCI\Bundle\RequestThemeBundle\Theme\ThemeInterface;
use IDCI\Bundle\RequestThemeBundle\Theme\ThemeManager;

class ThemeTwigExtension extends \Twig_Extension
{
    /**
     * @var ThemeManager
     */
    private $themeManager;

    /**
     * Constructor
     *
     * @param ThemeManager $themeManager
     */
    public function __construct(ThemeManager $themeManager)
    {
        $this->themeManager = $themeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'theme_path',
                array($this, 'themePath'),
                array('is_safe' => array('html', 'js'))
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'idci_request_theme_twig_extension';
    }

    /**
     * Returns the full theme path
     *
     * @param string $path
     *
     * @return string
     */
    public function themePath($path)
    {
        return $this->themeManager->getTemplate($path);
    }
}
