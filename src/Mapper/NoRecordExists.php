<?php
/**
 * @see https://github.com/dotkernel/dot-validator/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-validator/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Validator\Mapper;

/**
 * Class NoRecordExists
 * @package Dot\User\Validator
 */
class NoRecordExists extends AbstractRecord
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        $valid = true;
        $this->setValue($value);
        $result = $this->query($value);
        if ($result) {
            $valid = false;
            $this->error(self::ERROR_RECORD_FOUND);
        }
        return $valid;
    }
}
