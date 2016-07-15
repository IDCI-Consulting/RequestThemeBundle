<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
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
            ->setAllowedTypes(array(
                'client_ips'     => array('null', 'array'),
                'client_ip'      => array('null', 'string'),
                'script_name'    => array('null', 'string'),
                'path_info'      => array('null', 'string'),
                'base_path'      => array('null', 'string'),
                'base_url'       => array('null', 'string'),
                'scheme'         => array('null', 'string'),
                'port'           => array('null', 'string'),
                'http_host'      => array('null', 'string'),
                'request_format' => array('null', 'string'),
                'content_type'   => array('null', 'string'),
                'default_locale' => array('null', 'string'),
                'locale'         => array('null', 'string'),
                'languages'      => array('null', 'array'),
                'charsets'       => array('null', 'array'),
            ))
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