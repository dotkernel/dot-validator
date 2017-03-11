<?php
/**
 * @see https://github.com/dotkernel/dot-validator/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-validator/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Validator\Factory;

use Dot\Mapper\Mapper\MapperManager;
use Dot\Validator\Mapper\AbstractRecord;
use Interop\Container\ContainerInterface;

/**
 * Class MapperValidatorFactory
 * @package Dot\Validator\Factory
 */
class MapperValidatorFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var AbstractRecord $validator */
        $validator = new $requestedName($options);
        $validator->setMapperManager($container->get(MapperManager::class));

        return $validator;
    }
}
