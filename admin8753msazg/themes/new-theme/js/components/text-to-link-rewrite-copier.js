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

const $ = window.$;

/**
 * Component which allows to copy regular text to url friendly text
 *
 * Usage example in template:
 *
 * <input name="source-input" class="js-link-rewrite-copier-source"> // The original text will be taken from this element
 * <input name="destination-input" class="js-link-rewrite-copier-destination"> // Modified text will be added to this input
 *
 * in javascript:
 *
 * textToLinkRewriteCopier({
 *   sourceElementSelector: '.js-link-rewrite-copier-source'
 *   destinationElementSelector: '.js-link-rewrite-copier-destination',
 * });
 *
 * If the source-input has value "test name" the link rewrite value will be "test-name".
 * If the source-input has value "test name #$" link rewrite will be "test-name-" since #$ are un allowed characters in url.
 *
 * You can also pass additional options to change the event name, or encoding format:
 *
 * textToLinkRewriteCopier({
 *   sourceElementSelector: '.js-link-rewrite-copier-source'
 *   destinationElementSelector: '.js-link-rewrite-copier-destination',
 *   options: {
 *     eventName: 'change', // default is 'input'
 *   }
 * });
 *
 */
const textToLinkRewriteCopier = ({sourceElementSelector, destinationElementSelector, options = {eventName: 'input'}}) => {
  $(document).on(options.eventName, `${sourceElementSelector}`, (event) => {
    $(destinationElementSelector).val(str2url($(event.currentTarget).val(), 'UTF-8'));
  });
};

export default textToLinkRewriteCopier;
