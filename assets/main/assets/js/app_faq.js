"use strict";var app_faq={init:function(){$(".app-faq-item").on("click",function(){$(this).toggleClass("open"),delayBeforeFire(function(){$(window).resize()},100)}),$("#app_faq_open").on("click",function(){$(".app-faq .app-faq-item").addClass("open"),delayBeforeFire(function(){$(window).resize()},100)}),$("#app_faq_hide").on("click",function(){$(".app-faq .app-faq-item").removeClass("open"),delayBeforeFire(function(){$(window).resize()},100)}),$("#app_faq_remove").on("click",function(){var a=$(".app-faq").find(".app-faq-highlight");a.each(function(){var a=$(this).html();$(this).after(a),$(this).remove()}),$("#app_faq_hide").trigger("click")}),this.search()},search:function(){$("#app_faq_form").on("submit",function(){var a=$("#app_faq_search").val();if(a.length>=3){$(".app-faq .app-faq-item").removeClass("open"),$(".app-faq").removeHighlight();var e=$(".app-faq .app-faq-item-content:containsi('"+a+"')");e.highlight(a),e.each(function(){$(this).parent(".app-faq-item").addClass("open")}),delayBeforeFire(function(){$(window).resize()},100)}return!1})}};$(function(){app_faq.init()});