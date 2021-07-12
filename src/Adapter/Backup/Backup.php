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

namespace PrestaShop\PrestaShop\Adapter\Backup;

use DateTimeImmutable;
use PrestaShop\PrestaShop\Adapter\Entity\PrestaShopBackup;
use PrestaShop\PrestaShop\Core\Backup\BackupInterface;

/**
 * Class Backup represents single database backup.
 *
 * @internal
 */
final class Backup implements BackupInterface
{
    /**
     * @var PrestaShopBackup
     */
    private $legacyBackup;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @param string $fileName Backup file name
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->legacyBackup = new PrestaShopBackup($fileName);
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilePath()
    {
        return $this->legacyBackup->getBackupPath() . $this->getFileName();
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->legacyBackup->getBackupURL();
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return filesize($this->legacyBackup->id);
    }

    /**
     * {@inheritdoc}
     */
    public function getAge()
    {
        return time() - $this->getDate()->getTimestamp();
    }

    /**
     * {@inheritdoc}
     */
    public function getDate()
    {
        list($timestamp) = explode('-', $this->fileName);

        return new DateTimeImmutable('@' . $timestamp);
    }
}
