<?php
/**
 * @copyright: DotKernel
 * @library: dot-validator
 * @author: n3vrax
 * Date: 1/25/2017
 * Time: 5:44 PM
 */

declare(strict_types = 1);

namespace Dot\Validator\Factory;

use Dot\Ems\Mapper\MapperManager;
use Dot\Validator\Ems\AbstractRecord;
use Interop\Container\ContainerInterface;

/**
 * Class EmsValidatorFactory
 * @package Dot\Validator\Factory
 */
class EmsValidatorFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var AbstractRecord $validator */
        $validator = new $requestedName($options);
        $validator->setMapperManager($container->get(MapperManager::class));

        return $validator;
    }
}
