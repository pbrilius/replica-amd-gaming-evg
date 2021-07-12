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


namespace PrestaShop\Module\PsEventbus\Repository;

use Context;
use Db;
use PrestaShop\PrestaShop\Core\Addon\Theme\ThemeManagerBuilder;
use Theme;

class ThemeRepository
{
    /**
     * @var Context
     */
    private $context;
    /**
     * @var Db
     */
    private $db;

    public function __construct(Context $context, Db $db)
    {
        $this->context = $context;
        $this->db = $db;
    }

    /**
     * @return array|mixed|null
     */
    public function getThemes()
    {
        if (version_compare(_PS_VERSION_, '1.7', '>')) {
            $themeRepository = (new ThemeManagerBuilder($this->context, $this->db))
                ->buildRepository($this->context->shop);

            $currentTheme = $this->context->shop->theme;
            $themes = $themeRepository->getList();

            return array_map(function ($key, $theme) use ($currentTheme) {
                return [
                    'id' => md5((string) $key),
                    'collection' => 'themes',
                    'properties' => [
                        'theme_id' => md5((string) $key),
                        'name' => (string) $theme->getName(),
                        'theme_version' => (string) $theme->get('version'),
                        'active' => $theme->getName() == $currentTheme->getName(),
                    ],
                ];
            }, array_keys($themes), $themes);
        } else {
            /* @phpstan-ignore-next-line */
            $themes = Theme::getAvailable(false);

            return array_map(function ($theme) {
                /* @phpstan-ignore-next-line */
                $themeObj = Theme::getByDirectory($theme);

                $themeData = [
                    'id' => md5($theme),
                    'collection' => 'themes',
                    'properties' => [],
                ];

                /* @phpstan-ignore-next-line */
                if ($themeObj instanceof Theme) {
                    /* @phpstan-ignore-next-line */
                    $themeInfo = Theme::getThemeInfo($themeObj->id);

                    $themeData['properties'] = [
                        'theme_id' => md5($theme),
                        'name' => isset($themeInfo['theme_name']) ? $themeInfo['theme_name'] : '',
                        'theme_version' => isset($themeInfo['theme_version']) ? $themeInfo['theme_version'] : '',
                        'active' => isset($themeInfo['theme_version']) ? false : (string) $this->context->theme->id == (string) $themeInfo['theme_id'],
                    ];
                } else {
                    $themeData['properties'] = [
                        'theme_id' => md5($theme),
                        'name' => $theme,
                        'theme_version' => '',
                        'active' => false,
                    ];
                }

                return $themeData;
            }, $themes);
        }
    }
}
