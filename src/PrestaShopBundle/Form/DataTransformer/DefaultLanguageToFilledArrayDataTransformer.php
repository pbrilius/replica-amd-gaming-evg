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

namespace PrestaShopBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class DefaultLanguageToFilledArrayDataTransformer is responsible for filling empty array values with
 * default language value if such exists.
 */
final class DefaultLanguageToFilledArrayDataTransformer implements DataTransformerInterface
{
    /**
     * @var int
     */
    private $defaultLanguageId;

    /**
     * @param int $defaultLanguageId
     */
    public function __construct($defaultLanguageId)
    {
        $this->defaultLanguageId = $defaultLanguageId;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        // No transformation is required here due to this data is being sent to template
        return $value;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $values
     */
    public function reverseTransform($values)
    {
        if (!$this->assertIsValidForDataTransforming($values)) {
            return $values;
        }

        $defaultValue = $values[$this->defaultLanguageId];
        foreach ($values as $languageId => $item) {
            if (!$item) {
                $values[$languageId] = $defaultValue;
            }
        }

        return $values;
    }

    /**
     * Checks if the value is array and default language key exists in array.
     *
     * @param array $values
     *
     * @return bool
     */
    private function assertIsValidForDataTransforming($values)
    {
        return is_array($values) && isset($values[$this->defaultLanguageId]) && $values[$this->defaultLanguageId];
    }
}
