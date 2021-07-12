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

namespace PrestaShop\PrestaShop\Core\Import\File\DataRow;

use ArrayIterator;

/**
 * Class DataRowCollection defines a collection of data rows.
 */
final class DataRowCollection implements DataRowCollectionInterface
{
    /**
     * @var array of DataRowInterface objects
     */
    private $dataRows = [];

    /**
     * {@inheritdoc}
     */
    public function addDataRow(DataRowInterface $dataRow)
    {
        $this->dataRows[] = $dataRow;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->dataRows);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->dataRows[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->dataRows[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->dataRows[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->dataRows);
    }

    /**
     * {@inheritdoc}
     */
    public function getLargestRowSize()
    {
        $maxSize = 0;

        foreach ($this->dataRows as $dataRow) {
            $maxSize = max($maxSize, count($dataRow));
        }

        return $maxSize;
    }
}
