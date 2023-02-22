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

//------------------------------------ Customer.mods Create & Update ---------------------------

window.showCreateCustomer = () => {
  document.getElementById("createCustomer").style.display = "flex";
};

window.hideCreateCustomer = () => {
  document.getElementById("createCustomer").style.display = "none";
};

window.showUpdateCustomer = (obj) => {
  document.getElementById("updateCustomer").style.display = "flex";

  console.log(obj.id);
  document.getElementById("updateId").value = obj.id;
  document.getElementById("updateComType").value = obj.comType;
  document.getElementById("updateComName").value = obj.comName;
  document.getElementById("updateComEmail").value = obj.comEmail;
  document.getElementById("updateComPhone").value = obj.comPhone;
  document.getElementById("updateComVat").value = obj.comVat;
};

window.hideUpdateCustomer = () => {
  document.getElementById("updateCustomer").style.display = "none";
};

// var row = document.querySelectorAll(".row");
// for (let i = 0; i < row.length; i++) {
//   row[i].addEventListener("click", (e) => {
//     const parentRow = e.target.parentElement;
//   });
// }

window.createCustomer = function () {
  const info = {
    userId: document.getElementById("createUserId").value,
    comType: document.getElementById("createComType").value,
    comName: document.getElementById("createComName").value,
    comEmail: document.getElementById("createComEmail").value,
    comPhone: document.getElementById("createComPhone").value,
    comVat: document.getElementById("createComVat").value,
  };

  //TODO ADD FORM VALIDATION ON info
  console.log(info);

  http
    .post("/admin/customer/create", info)
    .then((data) => {
      if (data === "done") {
        window.location = "/admin/customer";
      } else {
        let output = "<ul>";
        data.forEach((list) => {
          output += `<li>${list}</li>`;
        });
        output += "</ul>";
        document.getElementById("output").innerHTML = output;
      }
    })
    .catch((err) => console.log(err));
};

window.updateCustomer = function () {
  const info = {
    id: document.getElementById("updateId").value,
    userId: document.getElementById("updateUserId").value,
    comType: document.getElementById("updateComType").value,
    comName: document.getElementById("updateComName").value,
    comEmail: document.getElementById("updateComEmail").value,
    comPhone: document.getElementById("updateComPhone").value,
    comVat: document.getElementById("updateComVat").value,
  };

  //TODO ADD FORM VALIDATION ON info
  console.log(info);

  http
    .put("/admin/customer/update", info)
    .then((data) => {
      if (data === "done") {
        window.location = "/admin/customer";
      } else {
        let output = "<ul>";
        data.forEach((list) => {
          output += `<li>${list}</li>`;
        });
        output += "</ul>";
        document.getElementById("output").innerHTML = output;
      }
    })
    .catch((err) => console.log(err));
};

window.showCustomer = function (obj) {
  console.log(obj);
};
