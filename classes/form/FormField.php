<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
class FormFieldCore
{
    private $name = '';
    private $type = 'text';
    private $required = false;
    private $label = '';
    private $value = null;
    private $availableValues = [];
    private $maxLength = null;
    private $errors = [];
    private $constraints = [];

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'required' => $this->isRequired(),
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
            'availableValues' => $this->getAvailableValues(),
            'maxLength' => $this->getMaxLength(),
            'errors' => $this->getErrors(),
        ];
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setAvailableValues(array $availableValues)
    {
        $this->availableValues = $availableValues;

        return $this;
    }

    public function getAvailableValues()
    {
        return $this->availableValues;
    }

    public function addAvailableValue($availableValue, $label = null)
    {
        if (!$label) {
            $label = $availableValue;
        }

        $this->availableValues[$availableValue] = $label;

        return $this;
    }

    public function setMaxLength($max)
    {
        $this->maxLength = (int) $max;

        return $this;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($errorString)
    {
        $this->errors[] = $errorString;

        return $this;
    }

    public function setConstraints(array $constraints)
    {
        $this->constraints = $constraints;

        return $this;
    }

    public function addConstraint($constraint)
    {
        $this->constraints[] = $constraint;

        return $this;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }
}
