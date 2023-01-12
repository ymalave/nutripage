let tblPendientes, tblCompletados, tblProceso;
const myModal = new bootstrap.Modal(document.getElementById("modalPedidos"));

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
  //Cargar datos de los pedidos por procesar con datatable
  tblProceso = $("#tblProceso").DataTable({
    ajax: {
      url: base_url + "pedidos/listarProceso",
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
//Para cambiar el estado de los pedidos, de pendiente a procesar, y de
//por procesar a completado a traves del boton de la fila de la tabla
function cambiarProceso(idPedido, proceso) {
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
      const url = base_url + "pedidos/update/" + idPedido + "/" + proceso;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          const res = JSON.parse(this.responseText);
          // Si el pedido ha sido cambiado de estado, recargar la tabla
          if (res.icono == "success") {
            tblPendientes.ajax.reload();
            tblProceso.ajax.reload();
            tblCompletados.ajax.reload();
          }
          // Permite ejecutar las alertas
          Swal.fire("Aviso", res.msg, res.icono);
        }
      };
    }
  });
}
// Permite ver el detalle de los pedidos en un modal
function verPedido(idPedido) {
  const url = base_url + "clientes/verPedido/" + idPedido;
  const http = new XMLHttpRequest();
  http.open('GET', url, true);
  http.send();
  http.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = '';
      res.productos.forEach(row => {
        let subTotal = parseFloat(row.precio) * parseInt(row.cantidad);
        html += `<tr>
          <td>${row.producto}</td>
          <td><span class="badge bg-warning">${res.moneda + ' ' + row.precio}</span></td>
          <td><span class="badge bg-primary">${row.cantidad}</span></td>
          <td>${subTotal.toFixed(2)}</td>
        </tr>`; 
      });
      document.querySelector('#tablePedidos tbody').innerHTML = html;
      myModal.show();
    }
  }
}
