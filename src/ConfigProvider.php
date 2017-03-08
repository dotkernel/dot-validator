<?php
/**
 * @copyright: DotKernel
 * @library: dot-validator
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:31 PM
 */

declare(strict_types = 1);

namespace Dot\Validator;

use Dot\Validator\Factory\MapperValidatorFactory;
use Dot\Validator\Factory\ValidatorPluginManagerFactory;
use Dot\Validator\Mapper\NoRecordExists;
use Dot\Validator\Mapper\RecordExists;
use Zend\Validator\ValidatorPluginManager;

/**
 * Class ConfigProvider
 * @package Dot\Validator
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependenciesConfig(),

            'dot_validator' => [
                'validator_manager' => [
                    'factories' => [
                        NoRecordExists::class => MapperValidatorFactory::class,
                        RecordExists::class => MapperValidatorFactory::class,
                    ],
                    'aliases' => [
                        'emsnorecordexists' => NoRecordExists::class,
                        'emsNoRecordExists' => NoRecordExists::class,
                        'EmsNoRecordExists' => NoRecordExists::class,

                        'emsrecordexists' => RecordExists::class,
                        'emsRecordExists' => RecordExists::class,
                        'EmsRecordExists' => RecordExists::class,
                    ],
                ]
            ],
        ];
    }

    public function getDependenciesConfig(): array
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
