<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Brahim Boukoufallah <brahim.boukoufallah@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\RuleAssessor;

use Doctrine\Common\Util\Inflector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RequestRuleAssessor extends AbstractRuleAssessor
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultParameters(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'client_ips'     => null,
                'client_ip'      => null,
                'script_name'    => null,
                'path_info'      => null,
                'base_path'      => null,
                'base_url'       => null,
                'scheme'         => null,
                'port'           => null,
                'http_host'      => null,
                'request_format' => null,
                'content_type'   => null,
                'default_locale' => null,
                'locale'         => null,
                'languages'      => null,
                'charsets'       => null,

            ))
            ->setAllowedTypes('client_ips',     array('null', 'array'))
            ->setAllowedTypes('client_ip',      array('null', 'string'))
            ->setAllowedTypes('script_name',    array('null', 'string'))
            ->setAllowedTypes('path_info',      array('null', 'string'))
            ->setAllowedTypes('base_path',      array('null', 'string'))
            ->setAllowedTypes('base_url',       array('null', 'string'))
            ->setAllowedTypes('scheme',         array('null', 'string'))
            ->setAllowedTypes('port',           array('null', 'string'))
            ->setAllowedTypes('http_host',      array('null', 'string'))
            ->setAllowedTypes('request_format', array('null', 'string'))
            ->setAllowedTypes('content_type',   array('null', 'string'))
            ->setAllowedTypes('default_locale', array('null', 'string'))
            ->setAllowedTypes('locale',         array('null', 'string'))
            ->setAllowedTypes('languages',      array('null', 'array'))
            ->setAllowedTypes('charsets',       array('null', 'array'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function doMatch(Request $request, array $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            if (null !== $value) {
                $getter = sprintf(
                    'get%s',
                    Inflector::classify($key)
                );

                $requestValue = call_user_func_array(
                    array($request, $getter),
                    array()
                );

                return $requestValue === $value;
            }
        }
    }
}
