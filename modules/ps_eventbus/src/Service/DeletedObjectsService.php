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


namespace PrestaShop\Module\PsEventbus\Service;

use Context;
use PrestaShop\Module\PsEventbus\Exception\EnvVarException;
use PrestaShop\Module\PsEventbus\Repository\DeletedObjectsRepository;
use PrestaShopDatabaseException;

class DeletedObjectsService
{
    /**
     * @var Context
     */
    private $context;
    /**
     * @var DeletedObjectsRepository
     */
    private $deletedObjectsRepository;
    /**
     * @var ProxyService
     */
    private $proxyService;

    public function __construct(Context $context, DeletedObjectsRepository $deletedObjectsRepository, ProxyService $proxyService)
    {
        $this->context = $context;
        $this->deletedObjectsRepository = $deletedObjectsRepository;
        $this->proxyService = $proxyService;
    }

    /**
     * @param string $jobId
     *
     * @return array
     *
     * @throws PrestaShopDatabaseException|EnvVarException
     */
    public function handleDeletedObjectsSync($jobId)
    {
        $deletedObjects = $this->deletedObjectsRepository->getDeletedObjectsGrouped($this->context->shop->id);

        if (empty($deletedObjects)) {
            return [
                'total_objects' => 0,
            ];
        }

        $data = $this->formatData($deletedObjects);

        $response = $this->proxyService->delete($jobId, $data);

        if ($response['httpCode'] == 200) {
            foreach ($data as $dataItem) {
                $this->deletedObjectsRepository->removeDeletedObjects(
                    $dataItem['collection'],
                    $dataItem['deleteIds'],
                    $this->context->shop->id
                );
            }
        }

        return array_merge(
            [
                'job_id' => $jobId,
                'total_objects' => count($data),
            ],
            $response
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function formatData(array $data)
    {
        return array_map(function ($dataItem) {
            return [
                'collection' => $dataItem['type'],
                'deleteIds' => explode(';', $dataItem['ids']),
            ];
        }, $data);
    }
}
