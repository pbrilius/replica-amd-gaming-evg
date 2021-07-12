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

namespace PrestaShopBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Admin controller for the Feature pages.
 */
class FeatureController extends FrameworkBundleAdminController
{
    /**
     * Get all values for a given feature.
     *
     * @param int $idFeature The feature Id
     *
     * @return JsonResponse features list
     */
    public function getFeatureValuesAction($idFeature)
    {
        $response = new JsonResponse();
        $locales = $this->get('prestashop.adapter.legacy.context')->getLanguages();
        $data = [];

        if ($idFeature == 0) {
            return $response;
        }

        $featuresValues = $this->get('prestashop.adapter.data_provider.feature')->getFeatureValuesWithLang($locales[0]['id_lang'], $idFeature);

        if (count($featuresValues) !== 0) {
            $data['0'] = [
                'id' => 0,
                'value' => $this->trans('Choose a value', 'Admin.Catalog.Feature'),
            ];
        }

        foreach ($featuresValues as $featureValue) {
            if (isset($featureValue['custom']) && $featureValue['custom'] == 1) {
                continue;
            }
            $data[] = [
                'id' => $featureValue['id_feature_value'],
                'value' => $featureValue['value'],
            ];
        }

        $response->setData($data);

        return $response;
    }
}
