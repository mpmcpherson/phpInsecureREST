/* Do not modify this file directly. It is compiled from other files. */
!function(){var e,t,i,o=document.cookie.replace(/(?:(?:^|.*;\s*)eucookielaw\s*\=\s*([^;]*).*$)|^.*$/,"$1"),n=document.getElementById("eu-cookie-law"),s=document.querySelector(".widget_eu_cookie_law_widget"),a=s&&s.hasAttribute("data-customize-widget-id");if(e=function(){return Math.abs(document.body.getBoundingClientRect().y)},n.classList.contains("top")&&s.classList.add("top"),n.classList.contains("ads-active")){var c=document.cookie.replace(/(?:(?:^|.*;\s*)personalized-ads-consent\s*\=\s*([^;]*).*$)|^.*$/,"$1");""===o||""===c||a||n.parentNode.removeChild(n)}else""===o||a||n.parentNode.removeChild(n);document.body.appendChild(s),n.querySelector("form").addEventListener("submit",r),n.classList.contains("hide-on-scroll")?(t=e(),i=function(){Math.abs(e()-t)>50&&r()},window.addEventListener("scroll",i)):n.classList.contains("hide-on-time")&&setTimeout(r,1e3*n.getAttribute("data-hide-timeout"));var d=!1;function r(e){if(!d){d=!0,e&&e.preventDefault&&e.preventDefault(),n.classList.contains("hide-on-scroll")&&window.removeEventListener("scroll",i);var t=new Date;t.setTime(t.getTime()+24*n.getAttribute("data-consent-expiration")*60*60*1e3),document.cookie="eucookielaw="+t.getTime()+";path=/;expires="+t.toGMTString(),n.classList.contains("ads-active")&&n.classList.contains("hide-on-button")&&(document.cookie="personalized-ads-consent="+t.getTime()+";path=/;expires="+t.toGMTString()),n.classList.add("hide"),setTimeout(function(){n.parentNode.removeChild(n);var e=document.querySelector(".widget.widget_eu_cookie_law_widget");e.parentNode.removeChild(e)},400)}}}();