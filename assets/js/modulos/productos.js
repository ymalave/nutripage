const frm = document.querySelector("#frmRegistro");
const btnAccion = document.querySelector("#btnAccion");
let tblProductos;
//Activa el contenido del tab 'nuevo' cuando se toca el boton de editar
var firstTabEl = document.querySelector("#myTab li:last-child button");
var firstTab = new bootstrap.Tab(firstTabEl);

document.addEventListener("DOMContentLoaded", function () {
  //Cargar datos de los productos con datatable
  tblProductos = $("#tblProductos").DataTable({
    ajax: {
      url: base_url + "productos/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "precio" },
      { data: "cantidad" },
      { data: "imagen" },
      { data: "accion" },
    ],
    //Variables que tienen almacenadas codigo js para la
    //traducción y los botones personalizados del datatable
    language,
    dom,
    buttons,
  });
  // Le da funcionalidad al boton para
  // registrar los datos del nuevo producto
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "productos/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (http.readyState === 4 && http.status === 200) {
        const res = JSON.parse(this.responseText);
        // Si el registro ha sido insertado con exito, recargar la tabla
        if (res.icono == "success") {
          frm.reset();
          tblProductos.ajax.reload();
          document.querySelector("#imagen").value = "";
        }
        // Permite ejecutar las alertas
        Swal.fire("Aviso", res.msg, res.icono);
      }
    };
  });
});
//Para borrar productos registrados de la tabla usando el boton
function eliminarPro(idPro) {
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
      const url = base_url + "productos/delete/" + idPro;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el registro ha sido eliminado con exito, recargar la tabla
          if (res.icono == "success") {
            tblProductos.ajax.reload();
          }
          // Permite ejecutar las alertas
          Swal.fire("Aviso", res.msg, res.icono);
        }
      };
    }
  });
}
//Para editar los productos registrados de la tabla usando el boton
function editPro(idPro) {
  const url = base_url + "productos/edit/" + idPro;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (http.readyState === 4 && http.status === 200) {
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id;
      document.querySelector("#nombre").value = res.nombre;
      document.querySelector("#precio").value = res.precio;
      document.querySelector("#cantidad").value = res.cantidad;
      document.querySelector("#categoria").value = res.id_categoria;
      document.querySelector("#descripcion").value = res.descripcion;
      document.querySelector("#imagen_actual").value = res.imagen;
      btnAccion.textContent = "Modificar";
      firstTab.show();
    }
  };
}