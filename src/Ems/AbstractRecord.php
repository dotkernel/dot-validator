<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-ems
 * @author: n3vrax
 * Date: 6/23/2016
 * Time: 9:01 PM
 */

declare(strict_types = 1);

namespace Dot\Validator\Ems;

use Dot\Ems\Mapper\MapperInterface;
use Dot\Ems\Mapper\MapperManager;
use Zend\Validator\AbstractValidator;

/**
 * Class AbstractRecord
 * @package Dot\User\Validator
 */
abstract class AbstractRecord extends AbstractValidator
{
    /**
     * Error constants
     */
    const ERROR_NO_RECORD_FOUND = 'noRecordFound';
    const ERROR_RECORD_FOUND = 'recordFound';
    /**
     * @var array Message templates
     */
    protected $messageTemplates = array(
        self::ERROR_NO_RECORD_FOUND => "No record matching the input was found",
        self::ERROR_RECORD_FOUND => "A record matching the input was found",
    );
    /**
     * @var MapperManager
     */
    protected $mapperManager;

    /**
     * @var string
     */
    protected $field;

    /** @var  string */
    protected $entity;

    /** @var  array */
    protected $exclude;

    /**
     * Required options are:
     *  - key
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (!array_key_exists('field', $options)) {
            throw new \InvalidArgumentException('No field provided');
        }
        if (!array_key_exists('entity', $options)) {
            throw new \InvalidArgumentException('No entity name provided');
        }
        $this->setField($options['field']);
        $this->setEntity($options['entity']);

        if (isset($options['exclude']) && is_array($options['exclude'])) {
            $this->exclude = $options['exclude'];
        }

        parent::__construct($options);
    }

    /**
     * Grab the user from the mapper
     *
     * @param string $value
     * @return mixed
     */
    protected function query($value)
    {
        $conditions = [$this->field => $value];
        /** @var MapperInterface $mapper */
        $mapper = $this->mapperManager->get($this->getEntity());
        if (!empty($this->exclude)) {
            $field = $this->exclude['field'] ?? '';
            $excludedValue = $this->exclude['value'] ?? '';
            $operator = $this->exclude['operator'] ?? '!=';

            if (!empty($field) && !empty($excludedValue)) {
                $conditions[] = $mapper->quoteIdentifier($field) . $operator . $mapper->quoteValue($excludedValue);
            }
        }
        $result = $mapper->find('all', [
            'conditions' => $conditions
        ]);

        return $result;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     */
    public function setEntity(string $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return MapperManager
     */
    public function getMapperManager(): MapperManager
    {
        return $this->mapperManager;
    }

    /**
     * @param MapperManager $mapperManager
     */
    public function setMapperManager(MapperManager $mapperManager)
    {
        $this->mapperManager = $mapperManager;
    }

    /**
     * @return array
     */
    public function getExclude(): array
    {
        return $this->exclude;
    }

    /**
     * @param array $exclude
     */
    public function setExclude(array $exclude)
    {
        $this->exclude = $exclude;
    }
}
