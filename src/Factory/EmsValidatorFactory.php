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

use Dot\Ems\Service\ServiceInterface;
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
                unset($options['service']);
            }
        }

        if (!$service instanceof ServiceInterface) {
            throw new RuntimeException('Validator could not be created. ' .
                'Entity service dependency not found or not an instance of' . ServiceInterface::class);
        }

        /** @var AbstractRecord $validator */
        $validator = new $requestedName($options);
        $validator->setService($service);

        return $validator;
    }
}
