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
  <div class="col-md-4">
    <div class="movements">
      <PSButton
        type="button"
        class="update-qty float-sm-right"
        :class="classObject"
        :disabled="disabled"
        :primary="true"
        @click="sendQty"
      >
        <i class="material-icons">edit</i>
        {{trans('button_movement_type')}}
      </PSButton>
    </div>
  </div>
</template>

<script>
  import PSButton from '@app/widgets/ps-button';

  export default {
    computed: {
      disabled() {
        return !this.$store.state.hasQty;
      },
      classObject() {
        return {
          'btn-primary': !this.disabled,
        };
      },
    },
    methods: {
      sendQty() {
        this.$store.dispatch('updateQtyByProductsId');
      },
    },
    components: {
      PSButton,
    },
  };
</script>

<style lang="scss" scoped>
  @import "../../../../../../scss/config/_settings.scss";
  .update-qty {
    color: white;
    transition: background-color 0.2s ease;
  }
</style>
