<!--**
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
 *-->
<template>
    <div class="ps-card-header clearfix">
        </slot>
        <div class="justify-content-start">
            <slot name="headerLeft"></slot>
        </div>
        <div class="justify-content-end">
            <slot name="headerRight"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PsCardHeader'
}
</script>

<style scoped lang="scss">
.ps-card-header {
    padding: 10px !important;
    padding: .625rem ! important;
    background-color: #fafbfc !important;
    border-bottom: 1px solid #e5e5e5 !important;
    font-size: 1rem !important;
    font-weight: 600;
    line-height: 1.5 !important;
    color: #363a41 !important;
    margin: unset !important;
    margin-top: 0;
    text-transform: unset !important;
    font-family: Open Sans,Helvetica,Arial,sans-serif !important;
}
</style>

<style>
.ps-card-header .material-icons {
    vertical-align: text-bottom;
    color: #6c868e;
    margin-right: 5px;
}
</style>
