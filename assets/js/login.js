const btnRegister = document.querySelector("#btnRegister");
const frmRegister = document.querySelector("#frmRegister");

const registrarse = document.querySelector("#registrarse");
const nombreRegistro = document.querySelector("#nombreRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const claveRegistro = document.querySelector("#claveRegistro");

const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");

const login = document.querySelector("#login");
const correoLogin = document.querySelector("#correoLogin");
const claveLogin = document.querySelector("#claveLogin");

const modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'));
const inputBusqueda = document.querySelector('#inputModalSearch');

document.addEventListener("DOMContentLoaded", function () {
  btnRegister.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegister.classList.remove("d-none");
  });
  btnLogin.addEventListener("click", function () {
    frmRegister.classList.add("d-none");
    frmLogin.classList.remove("d-none");
  });
  //Registro de clientes 
  registrarse.addEventListener("click", function () {
    //Verifica que no se deje un campo sin rellenar en el registro
    if (nombreRegistro.value == "" || correoRegistro.value == "" || claveRegistro.value == "") {
      Swal.fire("Aviso", "¡Todos los campos son requeridos!", "warning");
    } else {
      let formData = new FormData();
      formData.append("nombre", nombreRegistro.value);
      formData.append("correo", correoRegistro.value);
      formData.append("clave", claveRegistro.value);
      const url = base_url + "clientes/registroDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire("Aviso", res.msg, res.icono);
          //Envia el correo de verificación al correo registrado si el registro es exitoso
          if (res.icono == "success") {
            setTimeout(() => {
              enviarCorreo(correoRegistro.value, res.token);
            }, 2000);
          }
        }
      }
    }
  });
  //Inicio de sesión de clientes
  login.addEventListener("click", function () {
    //Verifica que no se deje un campo sin rellenar en el registro
    if (correoLogin.value == "" || claveLogin.value == "") {
      Swal.fire("Aviso", "¡Todos los campos son requeridos!", "warning");
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("claveLogin", claveLogin.value);
      const url = base_url + "clientes/loginDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire("Aviso", res.msg, res.icono);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      }
    }
  });
  //Busqueda de productos
  inputBusqueda.addEventListener('keyup', function(e){
    const url = base_url + "principal/busqueda/" + e.target.value;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        let html = '';
        res.forEach(producto => {
          html += `
            <div class="col-12 col-md-4 mb-4">
              <div class="card h-100">
                <a href="${ base_url + 'principal/detail/' + producto.id }">
                <!-- Muestra la imagen del producto y su nombre -->
                  <img src="${ base_url + producto.imagen }" class="card-img-top" alt="${ producto.nombre }">
                </a>
                <div class="card-body">
                  <ul class="list-unstyled d-flex justify-content-between">
                    <li>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-warning fa fa-star"></i>
                      <i class="text-muted fa fa-star"></i>
                      <i class="text-muted fa fa-star"></i>
                    </li>
                    <!-- Muestra el precio de los productos -->
                    <li class="text-muted text-right">${ producto.precio }</li>
                  </ul>
                  <!-- Al tocar un producto muestra sus detalles -->
                  <a href="${ base_url + 'principal/detail/' + producto.id }" class="h2 text-decoration-none text-dark">${ producto.nombre }</a>
                  <!-- Muestra la descripcion del producto -->
                  <p class="card-text">
                    ${ producto.descripcion }
                  </p>
                </div>
              </div>
          </div>`;      
        });
        document.querySelector('#resultBusqueda').innerHTML = html;
      }
    }
  })
});
//Para enviar el correo de verificación
function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("correo", correo);
  formData.append("token", token);
  const url = base_url + "clientes/enviarCorreo";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(formData);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      Swal.fire("Aviso", res.msg, res.icono);
      if (res.icono == "success") {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}
//Cierra la ventana del carrito y abre la ventana de inicio de sesión
function abrirModalLogin() {
  myModal.hide();
  modalLogin.show();
}