!function e(s,t,n){function r(i,a){if(!t[i]){if(!s[i]){var c="function"==typeof require&&require;if(!a&&c)return c(i,!0);if(o)return o(i,!0);var u=new Error("Cannot find module '"+i+"'");throw u.code="MODULE_NOT_FOUND",u}var l=t[i]={exports:{}};s[i][0].call(l.exports,function(e){var t=s[i][1][e];return r(t?t:e)},l,l.exports,e,s,t,n)}return t[i].exports}for(var o="function"==typeof require&&require,i=0;i<n.length;i++)r(n[i]);return r}({1:[function(e,s,t){"use strict";var n=e("./jetpackSharing"),r=e("./thumbsUpDown"),o=e("./comments"),i=e("./subscribe"),a=e("./searchToggle");s.exports=function(){$(document).ready(function(){n.init(),r.init(),o.init(),i.init(),a.init()})}()},{"./comments":2,"./jetpackSharing":3,"./searchToggle":4,"./subscribe":5,"./thumbsUpDown":6}],2:[function(e,s,t){"use strict";s.exports=function(){function e(){var e=$(".wc-form-wrapper"),s=e.find(".wc_comm_submit"),t=e.find(".wpdiscuz-item"),n=t.find("[type=email]");n.attr({placeholder:"Email (Optional)"}),s.addClass("btn btn-primary").parent(".wc-field-submit").removeClass("wc-field-submit")}return{init:function(){e()}}}()},{}],3:[function(e,s,t){"use strict";s.exports=function(){function e(e){e.addClass("btn btn-default btn-sm small").removeClass(t.classNames.button)}function s(e){e.addClass("entry-action-title small").removeClass("sd-title")}var t={classNames:{wrapper:"post-content-wrapper .sharedaddy",newWrapper:"supplemental",button:"sd-button",sendBtn:"sharing_send",cancelBtn:"sharing_cancel",header:"sd-title"},selectors:{}};return"undefined"==typeof $?console.warn("The Polyphil jetpackSharing module requires jQuery!"):$.each(t.classNames,function(e,s){t.selectors[e]="."+s}),{init:function(){var n=$(t.selectors.wrapper),r=n.find(t.selectors.button),o=n.find(t.selectors.header);e(r),s(o),n.addClass("jetpack-sharing-ready")}}}()},{}],4:[function(e,s,t){"use strict";s.exports=function(){function e(){n.removeClass("toggle-show"),r=!1,$(window).off("resize",e)}function s(){n.addClass("toggle-show"),r=!0,$(window).on("resize",e)}function t(){r?e():s()}var n,r=!1;return{init:function(){n=$("#searchForm"),$(document.body).on("click",".search-toggle",t)}}}()},{}],5:[function(e,s,t){"use strict";s.exports=function(){function e(e,s){$.each(s,function(s,n){var r,o,i,a="button-"+s,c=$(n),u=$("<span/>").addClass("fa");c.is(t.selectors.itunes)?(r="fa-apple",i=t.selectors.itunes,o=" iTunes"):c.is(t.selectors.android)?(r="fa-android",i=t.selectors.android,o=" Android"):c.is(t.selectors.rss)&&(r="fa-rss",i=t.selectors.rss,o=" RSS"),u.addClass(r),c.removeClass(t.classNames.button+" "+i+" "+a).text(o).prepend(u),c.addClass("subscribe-link").appendTo(e)})}function s(e,s){var t=$("<span/>").addClass("subscribe-label");t.text(s.text()).prependTo(e),s.remove()}var t={classNames:{wrapper:"widget_powerpress_subscribe",button:"pp-ssb-btn",header:"widget-title",icon:"pp-ssb-ic",itunes:"pp-ssb-itunes",android:"pp-ssb-android",rss:"pp-ssb-rss"},selectors:{}};return"undefined"==typeof $?console.warn("The Polyphil subscribe module requires jQuery!"):$.each(t.classNames,function(e,s){t.selectors[e]="."+s}),{init:function(){var n=$(t.selectors.wrapper),r=$(t.selectors.header),o=$(t.selectors.button),i=$(t.selectors.icon);i.remove(),n.children().remove(),e(n,o),s(n,r),n.addClass("subscribe-ready")}}}()},{}],6:[function(e,s,t){"use strict";s.exports=function(){function e(e){e.addClass("btn btn-default btn-sm feedback-link")}function s(){var e=$("<h3/>").addClass("entry-action-title small").text("Feedback");return e}var t={classNames:{wrapper:"watch-action",button:"jlk",newWrapper:"supplemental"},selectors:{}};return"undefined"==typeof $?console.warn("The Polyphil thumbsUpDown module requires jQuery!"):$.each(t.classNames,function(e,s){t.selectors[e]="."+s}),{init:function(){var n=$(t.selectors.wrapper),r=$(t.selectors.button);e(r),n.prepend(s()).addClass("thumbs-up-down-ready")}}}()},{}]},{},[1]);
//# sourceMappingURL=scripts-app.js.map
