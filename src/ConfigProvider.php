<?php
/**
 * @see https://github.com/dotkernel/dot-validator/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-validator/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Validator;

use Dot\Validator\Factory\MapperValidatorFactory;
use Dot\Validator\Factory\ValidatorPluginManagerFactory;
use Dot\Validator\Mapper\NoRecordExists;
use Dot\Validator\Mapper\RecordExists;
use Laminas\Validator\ValidatorPluginManager;

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
                        'mappernorecordexists' => NoRecordExists::class,
                        'mapperNoRecordExists' => NoRecordExists::class,
                        'MapperNoRecordExists' => NoRecordExists::class,

                        'mapperrecordexists' => RecordExists::class,
                        'mapperRecordExists' => RecordExists::class,
                        'MapperRecordExists' => RecordExists::class,
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
