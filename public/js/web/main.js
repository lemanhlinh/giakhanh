/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/web/main.js":
/*!**********************************!*\
  !*** ./resources/js/web/main.js ***!
  \**********************************/
/***/ (() => {

eval("$(document).ready(function () {\n  var fixmeTop = $('.navbar-finalstyle').offset().top;\n  $(window).scroll(function () {\n    var currentScroll = $(window).scrollTop();\n    if (currentScroll >= fixmeTop) {\n      $('.navbar-finalstyle').css({\n        background: '#fff'\n      });\n      $('#app .navbar-finalstyle #main-menu ul li a').css({\n        color: '#000'\n      });\n      $('#app .navbar-finalstyle .form-select-lang').css({\n        color: '#625B5B'\n      });\n      $('#app .navbar-finalstyle .form-select-lang select').css({\n        color: '#625B5B'\n      });\n    } else {\n      $('.navbar-finalstyle').css({\n        background: 'none'\n      });\n      $('#app .navbar-finalstyle #main-menu ul li a').css({\n        color: '#fff'\n      });\n      $('#app .navbar-finalstyle .form-select-lang').css({\n        color: '#fff'\n      });\n      $('#app .navbar-finalstyle .form-select-lang select').css({\n        color: '#fff'\n      });\n    }\n  });\n  new Mmenu(document.querySelector(\"#menu-mobile\"));\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsImZpeG1lVG9wIiwib2Zmc2V0IiwidG9wIiwid2luZG93Iiwic2Nyb2xsIiwiY3VycmVudFNjcm9sbCIsInNjcm9sbFRvcCIsImNzcyIsImJhY2tncm91bmQiLCJjb2xvciIsIk1tZW51IiwicXVlcnlTZWxlY3RvciJdLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanM/OGE3MiJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICB2YXIgZml4bWVUb3AgPSAkKCcubmF2YmFyLWZpbmFsc3R5bGUnKS5vZmZzZXQoKS50b3A7XG4gICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIGN1cnJlbnRTY3JvbGwgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XG4gICAgICAgIGlmIChjdXJyZW50U2Nyb2xsID49IGZpeG1lVG9wKSB7XG4gICAgICAgICAgICAkKCcubmF2YmFyLWZpbmFsc3R5bGUnKS5jc3Moe1xuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICcjZmZmJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKCcjYXBwIC5uYXZiYXItZmluYWxzdHlsZSAjbWFpbi1tZW51IHVsIGxpIGEnKS5jc3Moe1xuICAgICAgICAgICAgICAgIGNvbG9yOiAnIzAwMCdcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJCgnI2FwcCAubmF2YmFyLWZpbmFsc3R5bGUgLmZvcm0tc2VsZWN0LWxhbmcnKS5jc3Moe1xuICAgICAgICAgICAgICAgIGNvbG9yOiAnIzYyNUI1QidcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJCgnI2FwcCAubmF2YmFyLWZpbmFsc3R5bGUgLmZvcm0tc2VsZWN0LWxhbmcgc2VsZWN0JykuY3NzKHtcbiAgICAgICAgICAgICAgICBjb2xvcjogJyM2MjVCNUInXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICQoJy5uYXZiYXItZmluYWxzdHlsZScpLmNzcyh7XG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogJ25vbmUnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICQoJyNhcHAgLm5hdmJhci1maW5hbHN0eWxlICNtYWluLW1lbnUgdWwgbGkgYScpLmNzcyh7XG4gICAgICAgICAgICAgICAgY29sb3I6ICcjZmZmJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKCcjYXBwIC5uYXZiYXItZmluYWxzdHlsZSAuZm9ybS1zZWxlY3QtbGFuZycpLmNzcyh7XG4gICAgICAgICAgICAgICAgY29sb3I6ICcjZmZmJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKCcjYXBwIC5uYXZiYXItZmluYWxzdHlsZSAuZm9ybS1zZWxlY3QtbGFuZyBzZWxlY3QnKS5jc3Moe1xuICAgICAgICAgICAgICAgIGNvbG9yOiAnI2ZmZidcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICBuZXcgTW1lbnUoZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcIiNtZW51LW1vYmlsZVwiKSk7XG59KTtcbiJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQ0MsUUFBUSxDQUFDLENBQUNDLEtBQUssQ0FBQyxZQUFXO0VBQ3pCLElBQUlDLFFBQVEsR0FBR0gsQ0FBQyxDQUFDLG9CQUFvQixDQUFDLENBQUNJLE1BQU0sRUFBRSxDQUFDQyxHQUFHO0VBQ25ETCxDQUFDLENBQUNNLE1BQU0sQ0FBQyxDQUFDQyxNQUFNLENBQUMsWUFBVztJQUN4QixJQUFJQyxhQUFhLEdBQUdSLENBQUMsQ0FBQ00sTUFBTSxDQUFDLENBQUNHLFNBQVMsRUFBRTtJQUN6QyxJQUFJRCxhQUFhLElBQUlMLFFBQVEsRUFBRTtNQUMzQkgsQ0FBQyxDQUFDLG9CQUFvQixDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUN4QkMsVUFBVSxFQUFFO01BQ2hCLENBQUMsQ0FBQztNQUNGWCxDQUFDLENBQUMsNENBQTRDLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ2hERSxLQUFLLEVBQUU7TUFDWCxDQUFDLENBQUM7TUFDRlosQ0FBQyxDQUFDLDJDQUEyQyxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUMvQ0UsS0FBSyxFQUFFO01BQ1gsQ0FBQyxDQUFDO01BQ0ZaLENBQUMsQ0FBQyxrREFBa0QsQ0FBQyxDQUFDVSxHQUFHLENBQUM7UUFDdERFLEtBQUssRUFBRTtNQUNYLENBQUMsQ0FBQztJQUNOLENBQUMsTUFBTTtNQUNIWixDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ3hCQyxVQUFVLEVBQUU7TUFDaEIsQ0FBQyxDQUFDO01BQ0ZYLENBQUMsQ0FBQyw0Q0FBNEMsQ0FBQyxDQUFDVSxHQUFHLENBQUM7UUFDaERFLEtBQUssRUFBRTtNQUNYLENBQUMsQ0FBQztNQUNGWixDQUFDLENBQUMsMkNBQTJDLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQy9DRSxLQUFLLEVBQUU7TUFDWCxDQUFDLENBQUM7TUFDRlosQ0FBQyxDQUFDLGtEQUFrRCxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUN0REUsS0FBSyxFQUFFO01BQ1gsQ0FBQyxDQUFDO0lBQ047RUFDSixDQUFDLENBQUM7RUFFRixJQUFJQyxLQUFLLENBQUNaLFFBQVEsQ0FBQ2EsYUFBYSxDQUFDLGNBQWMsQ0FBQyxDQUFDO0FBQ3JELENBQUMsQ0FBQyIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy93ZWIvbWFpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/web/main.js"]();
/******/ 	
/******/ })()
;