const tblUsuarios = document.querySelector("#tblUsuarios");
const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));
let tblUsuario;

document.addEventListener("DOMContentLoaded", function () {
  //Cargar datos de los usuarios con datatable
  tblUsuario = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "correo" },
      { data: "perfil" },
      { data: "accion" },
    ],
    //Variables que tienen almacenadas codigo js para la
    //traducción y los votones personalizados del datatable
    language,
    dom,
    buttons,
  });
  // Le da funcionalidad al boton para mostrar el
  // modal que permite agregar un nuevo usuario
  nuevo.addEventListener("click", function () {
    document.querySelector('#id').value = '';
    titleModal.textContent = "Registrar usuario";
    btnAccion.textContent = "Registrar";
    frm.reset();
    document.querySelector('#clave').removeAttribute('readOnly');
    myModal.show();
  });
  // Le da funcionalidad al boton para
  // registrar los datos del nuevo usuario
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "usuarios/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (http.readyState === 4 && http.status === 200) {
        const res = JSON.parse(this.responseText);
        // Si el registro ha sido insertado con exito, recargar la tabla
        if (res.icono == "success") {
          myModal.hide();
          tblUsuario.ajax.reload();
        }
        // Permite ejecutar las alertas
        Swal.fire("Aviso", res.msg, res.icono);
      }
    };
  });
});
//Para borrar usuarios registrados de la tabla usando el boton
function eliminarUser(idUser) {
  //Alerta al tocar el boton de eliminar usuario
  Swal.fire({
    title: "Aviso",
    text: "¿Seguro que desea eliminar el usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "usuarios/delete/" + idUser;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el registro ha sido eliminado con exito, recargar la tabla
          if (res.icono == "success") {
            tblUsuario.ajax.reload();
          }
          // Permite ejecutar las alertas
          Swal.fire("Aviso", res.msg, res.icono);
        }
      };
    }
  });
}
//Para editar usuarios registrados de la tabla usando el boton
function editUser(idUser) {
  const url = base_url + "usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (http.readyState === 4 && http.status === 200) {
        const res = JSON.parse(this.responseText);
        document.querySelector('#id').value = res.id;
        document.querySelector('#nombre').value = res.nombres;
        document.querySelector('#apellido').value = res.apellidos;
        document.querySelector('#correo').value = res.correo;
        document.querySelector('#clave').setAttribute('readOnly', 'readOnly');
        btnAccion.textContent = 'Modificar';
        titleModal.textContent = 'Modificar usuario';
        myModal.show();
      }
    };
}