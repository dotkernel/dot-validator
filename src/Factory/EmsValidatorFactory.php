<?php
/**
 * @copyright: DotKernel
 * @library: dot-validator
 * @author: n3vrax
 * Date: 1/25/2017
 * Time: 5:44 PM
 */

namespace Dot\Validator\Factory;

use Dot\Validator\Ems\AbstractRecord;
use Interop\Container\ContainerInterface;
use Zend\Validator\Exception\RuntimeException;

/**
 * Class EmsValidatorFactory
 * @package Dot\Validator\Factory
 */
class EmsValidatorFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, $options = [])
    {
        $service = null;
        if (!empty($options)) {
            if (isset($options['service']) && $container->has($options['service'])) {
                $service = $container->get($options['service']);
            }
        }

        if (! $service) {
            throw new RuntimeException('Validator could not be created. Entity service dependency not found');
        }

        /** @var AbstractRecord $validator */
        $validator = new $requestedName($options);
        $validator->setService($service);

        return $validator;
    }
}
