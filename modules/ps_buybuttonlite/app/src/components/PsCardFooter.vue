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
    <div class="ps-card-footer clearfix">
        </slot>
        <div class="justify-content-start">
            <slot name="footerLeft"></slot>
        </div>
        <div class="justify-content-end">
            <slot name="footerRight"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PsCardFooter'
}
</script>

<style scoped lang="scss">
.ps-card-footer {
    padding: 10px 15px;
    padding: .625rem .9375rem;
    background-color: #fafbfc !important;
    border-top: 1px solid #e5e5e5;
    font-family: Open Sans,Helvetica,Arial,sans-serif !important;
}
</style>
