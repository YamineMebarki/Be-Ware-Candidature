/**
 * Created by mebarki on 27/06/2020.
 */
$(document).ready(function(){function o(){verticalOffset="undefined"!=typeof verticalOffset?verticalOffset:0,element=$("html"),offset=element.offset(),offsetTop=offset.top,$("html, body").animate({scrollTop:offsetTop},1000,"linear")}$(function(){$(document).on("scroll",function(){100<$(window).scrollTop()?$(".scroll-top-wrapper").addClass("show"):$(".scroll-top-wrapper").removeClass("show")}),$(".scroll-top-wrapper").on("click",o)})});
