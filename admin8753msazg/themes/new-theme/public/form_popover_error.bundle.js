window.form_popover_error=function(r){function t(n){if(o[n])return o[n].exports;var e=o[n]={i:n,l:!1,exports:{}};return r[n].call(e.exports,e,e.exports,t),e.l=!0,e.exports}var o={};return t.m=r,t.c=o,t.i=function(r){return r},t.d=function(r,o,n){t.o(r,o)||Object.defineProperty(r,o,{configurable:!1,enumerable:!0,get:n})},t.n=function(r){var o=r&&r.__esModule?function(){return r.default}:function(){return r};return t.d(o,"a",o),o},t.o=function(r,t){return Object.prototype.hasOwnProperty.call(r,t)},t.p="",t(t.s=463)}({463:function(r,t,o){"use strict";/**
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
var n=window.$;n(function(){n('[data-toggle="form-popover-error"]').popover({html:!0,content:function(){return o(this)}});var r=function(r){var o=n(r.currentTarget),e=o.closest(".form-group"),u=e.find(".invalid-feedback-container"),f=e.find(".form-popover-error"),i=u.width();f.css("width",i);var c=t(u,f);f.css("left",c+"px")},t=function(r,t){return r.offset().left-t.offset().left},o=function(r){var t=n(r).data("id");return n('.js-popover-error-content[data-id="'+t+'"]').html()};n(document).on("shown.bs.popover",'[data-toggle="form-popover-error"]',function(t){return r(t)})})}});