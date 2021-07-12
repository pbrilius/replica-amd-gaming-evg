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
import Vue from 'vue';
import VueRouter from 'vue-router';
import Overview from '@app/pages/stock/components/overview/index';
import Movements from '@app/pages/stock/components/movements/index';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  base: (() => {
    const hasIndex = /(index\.php)/.exec(window.location.href);
    return `${window.data.baseUrl}${hasIndex ? '/index.php' : ''}/sell/stocks`;
  })(),
  routes: [
    {
      path: '/',
      name: 'overview',
      component: Overview,
    },
    {
      path: '/movements',
      name: 'movements',
      component: Movements,
    },
  ],
});
