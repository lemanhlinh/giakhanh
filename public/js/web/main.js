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

eval("$(document).ready(function () {\n  // var fixmeTop = $('.navbar-finalstyle').offset().top;\n  // console.log(fixmeTop);\n  $(window).scroll(function () {\n    var currentScroll = $(window).scrollTop();\n    if (currentScroll >= 30) {\n      $('.navbar-finalstyle').addClass('active-menu');\n    } else {\n      $('.navbar-finalstyle').removeClass('active-menu');\n    }\n  });\n  new Mmenu(document.querySelector(\"#menu-mobile\"));\n  $('#change_locale').on('change', function () {\n    window.location = $(this).val();\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsIndpbmRvdyIsInNjcm9sbCIsImN1cnJlbnRTY3JvbGwiLCJzY3JvbGxUb3AiLCJhZGRDbGFzcyIsInJlbW92ZUNsYXNzIiwiTW1lbnUiLCJxdWVyeVNlbGVjdG9yIiwib24iLCJsb2NhdGlvbiIsInZhbCJdLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanM/OGE3MiJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICAvLyB2YXIgZml4bWVUb3AgPSAkKCcubmF2YmFyLWZpbmFsc3R5bGUnKS5vZmZzZXQoKS50b3A7XG4gICAgLy8gY29uc29sZS5sb2coZml4bWVUb3ApO1xuICAgICQod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKSB7XG4gICAgICAgIHZhciBjdXJyZW50U2Nyb2xsID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpO1xuICAgICAgICBpZiAoY3VycmVudFNjcm9sbCA+PSAzMCkge1xuICAgICAgICAgICAgJCgnLm5hdmJhci1maW5hbHN0eWxlJykuYWRkQ2xhc3MoJ2FjdGl2ZS1tZW51Jyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKCcubmF2YmFyLWZpbmFsc3R5bGUnKS5yZW1vdmVDbGFzcygnYWN0aXZlLW1lbnUnKTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG4gICAgbmV3IE1tZW51KGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIjbWVudS1tb2JpbGVcIikpO1xuXG4gICAgJCgnI2NoYW5nZV9sb2NhbGUnKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xuICAgICAgICB3aW5kb3cubG9jYXRpb24gPSAgJCh0aGlzKS52YWwoKTtcbiAgICB9KVxufSk7XG4iXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsWUFBVztFQUN6QjtFQUNBO0VBQ0FGLENBQUMsQ0FBQ0csTUFBTSxDQUFDLENBQUNDLE1BQU0sQ0FBQyxZQUFXO0lBQ3hCLElBQUlDLGFBQWEsR0FBR0wsQ0FBQyxDQUFDRyxNQUFNLENBQUMsQ0FBQ0csU0FBUyxFQUFFO0lBQ3pDLElBQUlELGFBQWEsSUFBSSxFQUFFLEVBQUU7TUFDckJMLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDTyxRQUFRLENBQUMsYUFBYSxDQUFDO0lBQ25ELENBQUMsTUFBTTtNQUNIUCxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ1EsV0FBVyxDQUFDLGFBQWEsQ0FBQztJQUN0RDtFQUNKLENBQUMsQ0FBQztFQUVGLElBQUlDLEtBQUssQ0FBQ1IsUUFBUSxDQUFDUyxhQUFhLENBQUMsY0FBYyxDQUFDLENBQUM7RUFFakRWLENBQUMsQ0FBQyxnQkFBZ0IsQ0FBQyxDQUFDVyxFQUFFLENBQUMsUUFBUSxFQUFFLFlBQVk7SUFDekNSLE1BQU0sQ0FBQ1MsUUFBUSxHQUFJWixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNhLEdBQUcsRUFBRTtFQUNwQyxDQUFDLENBQUM7QUFDTixDQUFDLENBQUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvd2ViL21haW4uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/web/main.js\n");

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