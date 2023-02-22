//------------------------------------Sidebar menu open and close ---------------------------
window.openNav = function () {
  document.getElementById("mySideNav").style.width = "300px";
};

window.closeNav = function () {
  document.getElementById("mySideNav").style.width = "0";
};

/**------------------------------------------------------------------------------------------
 * Modal Crud Open and closes the different modals across the board
 */
import EasyHTTP from "../vendor/EasyHTTP";
const http = new EasyHTTP();
