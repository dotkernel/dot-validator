<?php
/**
 * @copyright: DotKernel
 * @library: dot-validator
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:32 PM
 */

declare(strict_types = 1);

namespace Dot\Validator\Factory;

use Interop\Container\ContainerInterface;
use Zend\Validator\ValidatorPluginManager;

/**
 * Class ValidatorPluginManagerFactory
 * @package Dot\Validator\Factory
 */
class ValidatorPluginManagerFactory
{
    protected $configKey = 'dot_validator';
    protected $validatorPluginConfigKey = 'validator_manager';

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];
        if (isset($config[$this->configKey])
            && isset($config[$this->configKey][$this->validatorPluginConfigKey])
            && is_array($config[$this->configKey][$this->validatorPluginConfigKey])
        ) {
            $config = $config[$this->configKey][$this->validatorPluginConfigKey];
        }

        return new ValidatorPluginManager($container, $config);
    }
}
