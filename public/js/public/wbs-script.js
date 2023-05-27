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

/***/ "./resources/js/public/wbs-script.js":
/*!*******************************************!*\
  !*** ./resources/js/public/wbs-script.js ***!
  \*******************************************/
/***/ (() => {

eval("/**\r\n * Enable Bs Tooltip\r\n * @type {*[]}\r\n */\nvar tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-info=\"tooltip\"]'));\nvar tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {\n  return new bootstrap.Tooltip(tooltipTriggerEl);\n});\n/**\r\n * Modal Delete WBS\r\n */\n\nvar wbsRemoveFeedback = document.getElementById('wbsRemoveFeedback');\nwbsRemoveFeedback.addEventListener('show.bs.modal', function (event) {\n  var button = event.relatedTarget;\n  var recipient = button.getAttribute('data-bs-feedback-id'); // let modalTitle = wbsRemoveFeedback.querySelector('.modal-title')\n\n  var FeedbackInputId = wbsRemoveFeedback.querySelector('.modal-footer input'); //modalTitle.textContent = 'New message to ' + recipient\n  //FeedbackInputId.value = recipient\n\n  $('#remove_id_feedback').val(recipient);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcHVibGljL3dicy1zY3JpcHQuanM/YzZjMyJdLCJuYW1lcyI6WyJ0b29sdGlwVHJpZ2dlckxpc3QiLCJzbGljZSIsImNhbGwiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJ0b29sdGlwTGlzdCIsIm1hcCIsInRvb2x0aXBUcmlnZ2VyRWwiLCJib290c3RyYXAiLCJUb29sdGlwIiwid2JzUmVtb3ZlRmVlZGJhY2siLCJnZXRFbGVtZW50QnlJZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJldmVudCIsImJ1dHRvbiIsInJlbGF0ZWRUYXJnZXQiLCJyZWNpcGllbnQiLCJnZXRBdHRyaWJ1dGUiLCJGZWVkYmFja0lucHV0SWQiLCJxdWVyeVNlbGVjdG9yIiwiJCIsInZhbCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQSxJQUFJQSxrQkFBa0IsR0FBRyxHQUFHQyxLQUFILENBQVNDLElBQVQsQ0FBY0MsUUFBUSxDQUFDQyxnQkFBVCxDQUEwQiwwQkFBMUIsQ0FBZCxDQUF6QjtBQUNBLElBQUlDLFdBQVcsR0FBR0wsa0JBQWtCLENBQUNNLEdBQW5CLENBQXVCLFVBQVVDLGdCQUFWLEVBQTRCO0FBQ25FLFNBQU8sSUFBSUMsU0FBUyxDQUFDQyxPQUFkLENBQXNCRixnQkFBdEIsQ0FBUDtBQUNELENBRmlCLENBQWxCO0FBSUE7QUFDQTtBQUNBOztBQUVBLElBQUlHLGlCQUFpQixHQUFHUCxRQUFRLENBQUNRLGNBQVQsQ0FBd0IsbUJBQXhCLENBQXhCO0FBQ0FELGlCQUFpQixDQUFDRSxnQkFBbEIsQ0FBbUMsZUFBbkMsRUFBb0QsVUFBVUMsS0FBVixFQUFpQjtBQUNuRSxNQUFJQyxNQUFNLEdBQUdELEtBQUssQ0FBQ0UsYUFBbkI7QUFDQSxNQUFJQyxTQUFTLEdBQUdGLE1BQU0sQ0FBQ0csWUFBUCxDQUFvQixxQkFBcEIsQ0FBaEIsQ0FGbUUsQ0FHbkU7O0FBQ0EsTUFBSUMsZUFBZSxHQUFHUixpQkFBaUIsQ0FBQ1MsYUFBbEIsQ0FBZ0MscUJBQWhDLENBQXRCLENBSm1FLENBTW5FO0FBQ0E7O0FBRUVDLEVBQUFBLENBQUMsQ0FBQyxxQkFBRCxDQUFELENBQXlCQyxHQUF6QixDQUE2QkwsU0FBN0I7QUFFSCxDQVhEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXHJcbiAqIEVuYWJsZSBCcyBUb29sdGlwXHJcbiAqIEB0eXBlIHsqW119XHJcbiAqL1xyXG52YXIgdG9vbHRpcFRyaWdnZXJMaXN0ID0gW10uc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdbZGF0YS1icy1pbmZvPVwidG9vbHRpcFwiXScpKVxyXG52YXIgdG9vbHRpcExpc3QgPSB0b29sdGlwVHJpZ2dlckxpc3QubWFwKGZ1bmN0aW9uICh0b29sdGlwVHJpZ2dlckVsKSB7XHJcbiAgcmV0dXJuIG5ldyBib290c3RyYXAuVG9vbHRpcCh0b29sdGlwVHJpZ2dlckVsKVxyXG59KVxyXG5cclxuLyoqXHJcbiAqIE1vZGFsIERlbGV0ZSBXQlNcclxuICovXHJcblxyXG5sZXQgd2JzUmVtb3ZlRmVlZGJhY2sgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnd2JzUmVtb3ZlRmVlZGJhY2snKVxyXG53YnNSZW1vdmVGZWVkYmFjay5hZGRFdmVudExpc3RlbmVyKCdzaG93LmJzLm1vZGFsJywgZnVuY3Rpb24gKGV2ZW50KSB7XHJcbiAgbGV0IGJ1dHRvbiA9IGV2ZW50LnJlbGF0ZWRUYXJnZXRcclxuICBsZXQgcmVjaXBpZW50ID0gYnV0dG9uLmdldEF0dHJpYnV0ZSgnZGF0YS1icy1mZWVkYmFjay1pZCcpXHJcbiAgLy8gbGV0IG1vZGFsVGl0bGUgPSB3YnNSZW1vdmVGZWVkYmFjay5xdWVyeVNlbGVjdG9yKCcubW9kYWwtdGl0bGUnKVxyXG4gIGxldCBGZWVkYmFja0lucHV0SWQgPSB3YnNSZW1vdmVGZWVkYmFjay5xdWVyeVNlbGVjdG9yKCcubW9kYWwtZm9vdGVyIGlucHV0JylcclxuXHJcbiAgLy9tb2RhbFRpdGxlLnRleHRDb250ZW50ID0gJ05ldyBtZXNzYWdlIHRvICcgKyByZWNpcGllbnRcclxuICAvL0ZlZWRiYWNrSW5wdXRJZC52YWx1ZSA9IHJlY2lwaWVudFxyXG5cclxuICAgICQoJyNyZW1vdmVfaWRfZmVlZGJhY2snKS52YWwocmVjaXBpZW50KTtcclxuXHJcbn0pXHJcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcHVibGljL3dicy1zY3JpcHQuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/public/wbs-script.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/public/wbs-script.js"]();
/******/ 	
/******/ })()
;