// Llamada a las funciones
productosMinimos();
topProductos();
// Permite mostrar los productos minimos en el grafico
function productosMinimos() {
  const url = base_url + "admin/productosMinimos";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (http.readyState === 4 && http.status === 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      // Permite tomar los nombres y cantidades de los
      // productos con menos stock recibidas por la consulta
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]["nombre"]);
        cantidad.push(res[i]["cantidad"]);
      }
      // Reporte de productos minimos en stock, permite
      // que el grafico funcione y muestre las estadisticas
      var ctx = document.getElementById("chart4").getContext("2d");

      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, "#FFD24D");
      gradientStroke1.addColorStop(1, "#ffc107");

      var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, "#F47385");
      gradientStroke2.addColorStop(1, "#fd3550");

      var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, "#42e695");
      gradientStroke3.addColorStop(1, "#15ca20");

      var myChart = new Chart(ctx, {
        type: "pie",
        data: {
          labels: nombre,
          datasets: [
            {
              backgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
              ],

              hoverBackgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
              ],

              data: cantidad,
              borderWidth: [1, 1, 1],
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 0,
          legend: {
            position: "bottom",
            display: false,
            labels: {
              boxWidth: 8,
            },
          },
          tooltips: {
            displayColors: false,
          },
        },
      });
    }
  };
}
// Permite mostrar los productos mas vendidos en el grafico
function topProductos() {
  const url = base_url + "admin/topProductos";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (http.readyState === 4 && http.status === 200) {
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      // Permite tomar los nombres y cantidades de los
      // productos con menos stock recibidas por la consulta
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]["producto"]);
        cantidad.push(res[i]["total"]);
      }
      // Reporte de productos minimos en stock, permite
      // que el grafico funcione y muestre las estadisticas
      var ctx = document.getElementById("topProductos").getContext("2d");

      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, "#FFD24D");
      gradientStroke1.addColorStop(1, "#ffc107");

      var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, "#F47385");
      gradientStroke2.addColorStop(1, "#fd3550");

      var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, "#42e695");
      gradientStroke3.addColorStop(1, "#15ca20");

      var myChart = new Chart(ctx, {
        type: "pie",
        data: {
          labels: nombre,
          datasets: [
            {
              backgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
              ],

              hoverBackgroundColor: [
                gradientStroke1,
                gradientStroke2,
                gradientStroke3,
              ],

              data: cantidad,
              borderWidth: [1, 1, 1],
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 0,
          legend: {
            position: "bottom",
            display: false,
            labels: {
              boxWidth: 8,
            },
          },
          tooltips: {
            displayColors: false,
          },
        },
      });
    }
  };
}