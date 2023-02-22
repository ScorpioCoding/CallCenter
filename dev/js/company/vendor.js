/**------------------------------------------------------------------------------------------
 * Modal Crud Open and closes the different modals across the board
 */
import EasyHTTP from "../EasyHTTP.js";
const http = new EasyHTTP();

//------------------------------------Sidebar menu open and close ---------------------------
window.openNav = function () {
  document.getElementById("mySideNav").style.width = "300px";
};

window.closeNav = function () {
  document.getElementById("mySideNav").style.width = "0";
};
