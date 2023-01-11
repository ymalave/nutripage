let tblPendientes, tblCompletados;
//Activa el contenido del tab 'nuevo' cuando se toca el boton de editar
var firstTabEl = document.querySelector("#myTab li:last-child button");
var firstTab = new bootstrap.Tab(firstTabEl);

document.addEventListener("DOMContentLoaded", function () {
  //Cargar datos de los pedidos pendientes con datatable
  tblPendientes = $("#tblPendientes").DataTable({
    ajax: {
      url: base_url + "pedidos/listarPendientes",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "estado" },
      { data: "fecha" },
      { data: "email" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "direccion" },
      { data: "accion" },
    ],
    //Variables que tienen almacenadas codigo js para la
    //traducción y los botones personalizados del datatable
    language,
    dom,
    buttons,
  });
  //Cargar datos de los pedidos completados con datatable
  tblCompletados = $("#tblCompletados").DataTable({
    ajax: {
      url: base_url + "pedidos/listarCompletados",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "estado" },
      { data: "fecha" },
      { data: "email" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "direccion" },
      { data: "accion" },
    ],
    //Variables que tienen almacenadas codigo js para la
    //traducción y los botones personalizados del datatable
    language,
    dom,
    buttons,
  });
});
//Para cambiar el estado de los pedidos, de pendiente a 
//completado a traves del boton de la fila de la tabla
function cambiarProceso(idPedido) {
  //Alerta al tocar el boton de cambiar el estado del pedido
  Swal.fire({
    title: "Aviso",
    text: "¿Seguro que desea cambiar el estado del pedido?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "pedidos/update/" + idPedido;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el pedido ha sido cambiado de estado, recargar la tabla
          if (res.icono == "success") {
            tblPendientes.ajax.reload();
          }
          // Permite ejecutar las alertas
          Swal.fire("Aviso", res.msg, res.icono);
        }
      };
    }
  });
}