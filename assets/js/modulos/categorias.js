const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));
let tblCategorias;

document.addEventListener("DOMContentLoaded", function () {
  //Cargar datos de las categorias con datatable
  tblCategorias = $("#tblCategorias").DataTable({
    ajax: {
      url: base_url + "categorias/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "categoria" },
      { data: "imagen" },
      { data: "accion" }
    ],
    //Variables que tienen almacenadas codigo js para la
    //traducción y los botones personalizados del datatable
    language,
    dom,
    buttons,
  });
  // Le da funcionalidad al boton para mostrar el
  // modal que permite agregar una nueva categoria
  nuevo.addEventListener("click", function () {
    document.querySelector('#id').value = '';
    document.querySelector('#imagen_actual').value = '';
    document.querySelector('#imagen').value = '';
    titleModal.textContent = "Nueva categoría";
    btnAccion.textContent = "Registrar";
    frm.reset();
    myModal.show();
  });
  // Le da funcionalidad al boton para
  // registrar los datos de la nueva categoria
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "categorias/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (http.readyState === 4 && http.status === 200) {
        const res = JSON.parse(this.responseText);
        // Si el registro ha sido insertado con exito, recargar la tabla
        if (res.icono == "success") {
          myModal.hide();
          tblCategorias.ajax.reload();
          document.querySelector('#imagen').value = '';
        }
        // Permite ejecutar las alertas
        Swal.fire("Aviso", res.msg, res.icono);
      }
    };
  });
});
//Para borrar categorias registradas de la tabla usando el boton
function eliminarCat(idCat) {
  //Alerta al tocar el boton de eliminar categoria
  Swal.fire({
    title: "Aviso",
    text: "¿Seguro que desea eliminar la categoría?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "categorias/delete/" + idCat;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el registro ha sido eliminado con exito, recargar la tabla
          if (res.icono == "success") {
            tblCategorias.ajax.reload();
          }
          // Permite ejecutar las alertas
          Swal.fire("Aviso", res.msg, res.icono);
        }
      };
    }
  });
}
//Para editar las categorias registradas de la tabla usando el boton
function editCat(idCat) {
  const url = base_url + "categorias/edit/" + idCat;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (http.readyState === 4 && http.status === 200) {
        const res = JSON.parse(this.responseText);
        document.querySelector('#id').value = res.id;
        document.querySelector('#categoria').value = res.categoria;
        document.querySelector('#imagen_actual').value = res.imagen;
        btnAccion.textContent = 'Modificar';
        titleModal.textContent = 'Modificar categoría';
        myModal.show();
      }
    };
}