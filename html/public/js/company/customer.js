import EasyHTTP from"../EasyHTTP.js";const http=new EasyHTTP;window.openNav=function(){document.getElementById("mySideNav").style.width="300px"},window.closeNav=function(){document.getElementById("mySideNav").style.width="0"},window.showCreateCustomer=()=>{document.getElementById("createCustomer").style.display="flex"},window.hideCreateCustomer=()=>{document.getElementById("createCustomer").style.display="none"},window.showUpdateCustomer=e=>{document.getElementById("updateCustomer").style.display="flex",console.log(e.id),document.getElementById("updateId").value=e.id,document.getElementById("updateComType").value=e.comType,document.getElementById("updateComName").value=e.comName,document.getElementById("updateComEmail").value=e.comEmail,document.getElementById("updateComPhone").value=e.comPhone,document.getElementById("updateComVat").value=e.comVat},window.hideUpdateCustomer=()=>{document.getElementById("updateCustomer").style.display="none"},window.createCustomer=function(){const e={userId:document.getElementById("createUserId").value,comType:document.getElementById("createComType").value,comName:document.getElementById("createComName").value,comEmail:document.getElementById("createComEmail").value,comPhone:document.getElementById("createComPhone").value,comVat:document.getElementById("createComVat").value};console.log(e),http.post("/admin/customer/create",e).then((e=>{if("done"===e)window.location="/admin/customer";else{let t="<ul>";e.forEach((e=>{t+=`<li>${e}</li>`})),t+="</ul>",document.getElementById("output").innerHTML=t}})).catch((e=>console.log(e)))},window.updateCustomer=function(){const e={id:document.getElementById("updateId").value,userId:document.getElementById("updateUserId").value,comType:document.getElementById("updateComType").value,comName:document.getElementById("updateComName").value,comEmail:document.getElementById("updateComEmail").value,comPhone:document.getElementById("updateComPhone").value,comVat:document.getElementById("updateComVat").value};console.log(e),http.put("/admin/customer/update",e).then((e=>{if("done"===e)window.location="/admin/customer";else{let t="<ul>";e.forEach((e=>{t+=`<li>${e}</li>`})),t+="</ul>",document.getElementById("output").innerHTML=t}})).catch((e=>console.log(e)))},window.showCustomer=function(e){console.log(e)};