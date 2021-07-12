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
  <div class="form-group">
    <label>{{label}}</label>
    <textarea class="form-control" rows="2" v-model="getTranslated" :class="{ missing : isMissing }"></textarea>
    <PSButton class="mt-3 float-sm-right" :primary="false" ghost @click="resetTranslation">
      {{ trans('button_reset') }}
    </PSButton>
    <small class="mt-3">{{extraInfo}}</small>
  </div>
</template>

<script>
  import PSButton from '@app/widgets/ps-button';
  import { EventBus } from '@app/utils/event-bus';

  export default {
    name: 'TranslationInput',
    props: {
      id: {
        type: Number,
      },
      extraInfo: {
        type: String,
        required: false,
      },
      label: {
        type: String,
        required: true,
      },
      translated: {
        required: true,
      },
    },
    computed: {
      getTranslated: {
        get() {
          return this.translated.database ? this.translated.database : this.translated.xliff;
        },
        set(modifiedValue) {
          const modifiedTranslated = this.translated;
          modifiedTranslated.database = modifiedValue;
          modifiedTranslated.edited = modifiedValue;
          this.$emit('input', modifiedTranslated);
          this.$emit('editedAction', {
            translation: modifiedTranslated,
            id: this.id,
          });
        },
      },
      isMissing() {
        return this.getTranslated === null;
      },
    },
    methods: {
      resetTranslation() {
        this.getTranslated = '';
        EventBus.$emit('resetTranslation', this.translated);
      },
    },
    components: {
      PSButton,
    },
  };
</script>

<style lang="scss" scoped>
  @import "../../../../../../scss/config/_settings.scss";

  .form-group {
    overflow: hidden;
  }
  .missing {
    border: 1px solid $danger;
  }
</style>
