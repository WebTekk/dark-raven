<?php

namespace App\DataRow;

/**
 * Class Validation
 */
class Validation extends AbstractRow
{
    /**
     * @var array Errors
     */
    protected $errors = [];

    /**
     * Adds new error
     *
     * @param string $key Key
     * @param string $value Value
     * @return void
     */
    public function addError(string $key, string $value) : void
    {
        $this->errors[$key] = $value;
    }

    /**
     * Return true if there are no errors
     *
     * @return bool
     */
    public function isValid() : bool
    {
        return empty($this->errors);
    }

    /**
     * Return all errors
     *
     * @return array Errors
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
}
