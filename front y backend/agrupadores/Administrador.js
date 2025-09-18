function cargarEnFrame(ruta) {
  const main = document.getElementById('main-content');
  main.innerHTML = `<iframe src="${ruta}" style="width:100%; height:94vh; border:none;"></iframe>`;
}
//Carga el dashboard al cargar el DOM
document.addEventListener('DOMContentLoaded', () => {
    cargarEnFrame('../dashboard/Grafica.html'); // Ruta del iframe por defecto
  });

google.charts.load('current', { packages: ['corechart'] });

function mostrarEstadisticas(e) {
  e.preventDefault();
  const main = document.getElementById("main-content");
  main.innerHTML = `
    <h2 class="text-center text-warning mb-4">Estadísticas</h2>
    <div class="card bg-secondary p-4">
      <div class="row g-2">
        <div class="col-md-3">
          <select id="tipo" class="form-select">
            <option value="circular">Circular</option>
            <option value="columna">Columnas</option>
          </select>
        </div>
        <div class="col-md-4">
          <input id="titulo" class="form-control" placeholder="Título del gráfico">
        </div>
        <div class="col-md-5 d-flex gap-2">
          <button onclick="agregarDato()" class="btn btn-success w-50">Agregar Dato</button>
          <button onclick="cargarGrafico()" class="btn btn-primary w-50">Crear Gráfico</button>
        </div>
      </div>
      <div id="datos" class="mt-3">
        <div class="row g-2 mb-2">
          <div class="col"><input type="text" class="serie form-control" placeholder="Leyenda"></div>
          <div class="col"><input type="number" class="valor form-control" placeholder="Valor"></div>
        </div>
      </div>
      <div id="chart_div" class="mt-4" style="width:100%; height:400px;"></div>
    </div>
  `;
  google.charts.setOnLoadCallback(() => cargarGraficoInicial());
}

function agregarDato() {
  const datos = document.getElementById("datos");
  const fila = document.createElement("div");
  fila.className = "row g-2 mb-2";
  fila.innerHTML = `
    <div class="col"><input type="text" class="serie form-control" placeholder="Leyenda"></div>
    <div class="col"><input type="number" class="valor form-control" placeholder="Valor"></div>
  `;
  datos.appendChild(fila);
}

function cargarGrafico() {
  const tipo = document.getElementById("tipo").value;
  const titulo = document.getElementById("titulo").value || "Mi Gráfico";
  const series = document.querySelectorAll(".serie");
  const valores = document.querySelectorAll(".valor");
  const dataArray = [["Leyenda", "Valor"]];
  series.forEach((s, i) => {
    const leyenda = s.value || `Dato ${i + 1}`;
    const valor = parseFloat(valores[i].value) || 0;
    dataArray.push([leyenda, valor]);
  });

  const data = google.visualization.arrayToDataTable(dataArray);
  const options = {
    title: titulo,
    backgroundColor: '#333',
    titleTextStyle: { color: '#fff' },
    legend: { textStyle: { color: '#fff' } }
  };

  const chartDiv = document.getElementById('chart_div');
  const chart = tipo === "circular"
    ? new google.visualization.PieChart(chartDiv)
    : new google.visualization.ColumnChart(chartDiv);

  chart.draw(data, options);
}

function cargarGraficoInicial() {
  const data = google.visualization.arrayToDataTable([
    ['Servicio', 'Clientes'],
    ['Corte', 45],
    ['Barba', 25],
    ['Tinte', 15],
    ['Tratamiento', 15]
  ]);
  const options = {
    title: 'Distribución de Servicios',
    backgroundColor: '#333',
    titleTextStyle: { color: '#fff' },
    legend: { textStyle: { color: '#fff' } },
    pieHole: 0.4
  };
  new google.visualization.PieChart(document.getElementById('chart_div')).draw(data, options);
}
