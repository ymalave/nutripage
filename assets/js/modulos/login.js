const frm = document.querySelector("#formulario");
const email = document.querySelector("#email");
const clave = document.querySelector("#clave");

document.addEventListener("DOMContentLoaded", function () {
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    // Si el email y la clave estan vacios muestra alerta
    if (email.value == "" || clave.value == "") {
      alertas("Todos los campos son requeridos", "warning");
    } else {
      // Si el email y la clave con ingresados, comprobarlos
      let data = new FormData(this);
      const url = base_url + "admin/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el email y la clave con correctos
          // abrir la ventana de administracion
          if (res.icono == "success") {
            setTimeout(() => {
              window.location = base_url + "admin/home";
            }, 2000);
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
});
//Función para mostrar las alertas
function alertas(msg, icono) {
  Swal.fire("Aviso", msg, icono);
}