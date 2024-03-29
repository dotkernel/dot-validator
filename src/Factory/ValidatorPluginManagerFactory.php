<?php
/**
 * @see https://github.com/dotkernel/dot-validator/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-validator/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Validator\Factory;

use Psr\Container\ContainerInterface;
use Laminas\Validator\ValidatorPluginManager;

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
