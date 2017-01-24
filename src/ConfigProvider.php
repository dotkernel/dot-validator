<?php
/**
 * @copyright: DotKernel
 * @library: dot-validator
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:31 PM
 */

namespace Dot\Validator;

use Dot\Validator\Factory\ValidatorPluginManagerFactory;
use Zend\Validator\ValidatorPluginManager;

/**
 * Class ConfigProvider
 * @package Dot\Validator
 */
class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependenciesConfig(),

            'dot_validator' => [
                'validator_manager' => []
            ],
        ];
    }

    public function getDependenciesConfig()
    {
        return [
            'factories' => [
                'ValidatorManager' => ValidatorPluginManagerFactory::class,
            ],
            'aliases' => [
                ValidatorPluginManager::class => 'ValidatorManager',
            ]
        ];
    }
}
