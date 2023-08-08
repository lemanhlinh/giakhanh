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

eval("$(document).ready(function () {\n  var fixmeTop = $('.navbar-finalstyle').offset().top;\n  $(window).scroll(function () {\n    var currentScroll = $(window).scrollTop();\n    if (currentScroll > fixmeTop) {\n      $('.navbar-finalstyle').css({\n        background: '#fff'\n      });\n      $('#app .navbar-finalstyle #main-menu ul li a').css({\n        color: '#000'\n      });\n      $('#app .navbar-finalstyle .form-select-lang').css({\n        color: '#625B5B'\n      });\n      $('#app .navbar-finalstyle .form-select-lang select').css({\n        color: '#625B5B'\n      });\n    } else {\n      $('.navbar-finalstyle').css({\n        background: 'none'\n      });\n      $('#app .navbar-finalstyle #main-menu ul li a').css({\n        color: '#fff'\n      });\n      $('#app .navbar-finalstyle .form-select-lang').css({\n        color: '#fff'\n      });\n      $('#app .navbar-finalstyle .form-select-lang select').css({\n        color: '#fff'\n      });\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsImZpeG1lVG9wIiwib2Zmc2V0IiwidG9wIiwid2luZG93Iiwic2Nyb2xsIiwiY3VycmVudFNjcm9sbCIsInNjcm9sbFRvcCIsImNzcyIsImJhY2tncm91bmQiLCJjb2xvciJdLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanM/OGE3MiJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICB2YXIgZml4bWVUb3AgPSAkKCcubmF2YmFyLWZpbmFsc3R5bGUnKS5vZmZzZXQoKS50b3A7XG4gICAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIGN1cnJlbnRTY3JvbGwgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XG4gICAgICAgIGlmIChjdXJyZW50U2Nyb2xsID4gZml4bWVUb3ApIHtcbiAgICAgICAgICAgICQoJy5uYXZiYXItZmluYWxzdHlsZScpLmNzcyh7XG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogJyNmZmYnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICQoJyNhcHAgLm5hdmJhci1maW5hbHN0eWxlICNtYWluLW1lbnUgdWwgbGkgYScpLmNzcyh7XG4gICAgICAgICAgICAgICAgY29sb3I6ICcjMDAwJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKCcjYXBwIC5uYXZiYXItZmluYWxzdHlsZSAuZm9ybS1zZWxlY3QtbGFuZycpLmNzcyh7XG4gICAgICAgICAgICAgICAgY29sb3I6ICcjNjI1QjVCJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAkKCcjYXBwIC5uYXZiYXItZmluYWxzdHlsZSAuZm9ybS1zZWxlY3QtbGFuZyBzZWxlY3QnKS5jc3Moe1xuICAgICAgICAgICAgICAgIGNvbG9yOiAnIzYyNUI1QidcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLm5hdmJhci1maW5hbHN0eWxlJykuY3NzKHtcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAnbm9uZSdcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJCgnI2FwcCAubmF2YmFyLWZpbmFsc3R5bGUgI21haW4tbWVudSB1bCBsaSBhJykuY3NzKHtcbiAgICAgICAgICAgICAgICBjb2xvcjogJyNmZmYnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICQoJyNhcHAgLm5hdmJhci1maW5hbHN0eWxlIC5mb3JtLXNlbGVjdC1sYW5nJykuY3NzKHtcbiAgICAgICAgICAgICAgICBjb2xvcjogJyNmZmYnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICQoJyNhcHAgLm5hdmJhci1maW5hbHN0eWxlIC5mb3JtLXNlbGVjdC1sYW5nIHNlbGVjdCcpLmNzcyh7XG4gICAgICAgICAgICAgICAgY29sb3I6ICcjZmZmJ1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVc7RUFDekIsSUFBSUMsUUFBUSxHQUFHSCxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ0ksTUFBTSxFQUFFLENBQUNDLEdBQUc7RUFDbkRMLENBQUMsQ0FBQ00sTUFBTSxDQUFDLENBQUNDLE1BQU0sQ0FBQyxZQUFXO0lBQ3hCLElBQUlDLGFBQWEsR0FBR1IsQ0FBQyxDQUFDTSxNQUFNLENBQUMsQ0FBQ0csU0FBUyxFQUFFO0lBQ3pDLElBQUlELGFBQWEsR0FBR0wsUUFBUSxFQUFFO01BQzFCSCxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ3hCQyxVQUFVLEVBQUU7TUFDaEIsQ0FBQyxDQUFDO01BQ0ZYLENBQUMsQ0FBQyw0Q0FBNEMsQ0FBQyxDQUFDVSxHQUFHLENBQUM7UUFDaERFLEtBQUssRUFBRTtNQUNYLENBQUMsQ0FBQztNQUNGWixDQUFDLENBQUMsMkNBQTJDLENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQy9DRSxLQUFLLEVBQUU7TUFDWCxDQUFDLENBQUM7TUFDRlosQ0FBQyxDQUFDLGtEQUFrRCxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUN0REUsS0FBSyxFQUFFO01BQ1gsQ0FBQyxDQUFDO0lBQ04sQ0FBQyxNQUFNO01BQ0haLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDVSxHQUFHLENBQUM7UUFDeEJDLFVBQVUsRUFBRTtNQUNoQixDQUFDLENBQUM7TUFDRlgsQ0FBQyxDQUFDLDRDQUE0QyxDQUFDLENBQUNVLEdBQUcsQ0FBQztRQUNoREUsS0FBSyxFQUFFO01BQ1gsQ0FBQyxDQUFDO01BQ0ZaLENBQUMsQ0FBQywyQ0FBMkMsQ0FBQyxDQUFDVSxHQUFHLENBQUM7UUFDL0NFLEtBQUssRUFBRTtNQUNYLENBQUMsQ0FBQztNQUNGWixDQUFDLENBQUMsa0RBQWtELENBQUMsQ0FBQ1UsR0FBRyxDQUFDO1FBQ3RERSxLQUFLLEVBQUU7TUFDWCxDQUFDLENBQUM7SUFDTjtFQUNKLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQyIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy93ZWIvbWFpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

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