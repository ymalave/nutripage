const tableLista = document.querySelector('#tableListaProductos tbody');
const tblPendientes = document.querySelector('#tblPendientes');

document.addEventListener("DOMContentLoaded", function() {
  if (tableLista) {
    getListaProductos()
  }
  //Cargar datos de las compras pendientes con datatable
  $('#tblPendientes').DataTable({
    ajax: {
      url: base_url + 'clientes/listarPendientes',
      dataSrc: ''
    },
    columns: [
      { data: 'id_transaccion' },
      { data: 'monto' },
      { data: 'fecha' },
      { data: 'accion' }
    ],
    //Variables que tienen almacenadas codigo js para la 
    //traducción y los votones personalizados del datatable
    language, 
    dom,
    buttons
  });
});
//Obtiene la lista de productos del carrito y los muestra en el perfil del cliente
function getListaProductos() {
  let html = "";
  const url = base_url + "principal/listaProductos";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      //Si no se han pagado todos los productos mostrar los restantes
      if (res.totalPaypal > 0) {
        res.productos.forEach((producto) => {
          html += `
          <tr>
            <td><img class="img-thumbnail rounded-circle" src="${producto.imagen}" alt="" width="100"></td>
            <td>${producto.nombre}</td>
            <td><span class="badge bg-warning">${res.moneda + " " + producto.precio}</span></td>
            <td><span class="badge bg-primary">${producto.cantidad}</span></td>
            <td>${producto.subTotal}</td>
          </tr>`;
        });
        console.log(res.totalPaypal);
        tableLista.innerHTML = html;
        document.querySelector("#totalProducto").textContent ="Total a pagar: " + res.moneda + " " + res.total;
        botonPaypal(res.totalPaypal); //Ejecuta la funcion para pagar por paypal
      } else {
        tableLista.innerHTML = `
        <tr>
          <td colspan="5" class="text-center">¡Carrito vacío!</td>
        </tr>`;
      }
    }
  };
}
//Permite pagar a traves de paypal
function botonPaypal(total) {
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            registrarPedido(orderData)
          });
        }
      }).render('#paypal-button-container');
}
//Toma los datos del pago de la compra por paypal y los envia al controlador clientes
function registrarPedido(datos) {
    const url = base_url + 'clientes/registrarPedido';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify({
      pedidos: datos,
      productos: listaCarrito
    }));
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire("Aviso", res.msg, res.icono);
            //Si la compra ha sido registrada, borrar los productos del carrito
            if (res.icono == 'success') {
              localStorage.removeItem('listaCarrito');
              setTimeout(() => {
                window.location.reload();
              }, 2000);
            }
        }
    }
}
//Permite ver el estado del pedido pendiente seleccionado
function verPedido(idPedido) {
  //Muestra el modal del pedido pendiente
  const mPedido = new bootstrap.Modal(document.getElementById('modalPedido'));
  //Muestra el detalle del pedido pendiente
  const url = base_url + 'clientes/verPedido/' + idPedido;
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
      mPedido.show();
    }
  }
}