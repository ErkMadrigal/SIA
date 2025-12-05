const API_BASE_URL = window.env.API_URL + 'employees';

const dataTable = document.querySelector("#dataTable");
const inputLang = document.getElementById("inputLang");
const progressBar = document.querySelector("#progressBar");
const loadingContainer = document.querySelector("#loadingContainer");
const searchInput = document.getElementById("search");
const reload = document.querySelector("#reload");
const btnReset = document.querySelector("#btnReset");
const btnFiltro = document.querySelector("#btnFiltro");

let getEmpleados = {};

let totalEmpleados = 0;
let paginaActual = 1;

let puesto = document.getElementById("puesto");
let fechas = document.getElementById("fechas");
let zona = document.getElementById("zona");
const radios = document.getElementsByName('estatusRadio');

let selectedValue = null;

// Listener para radios estatus
Array.from(radios).forEach(radio => {
  radio.addEventListener('change', () => {
    if (radio.checked) {
      selectedValue = radio.value;
      getEmpleados.status = selectedValue;
    }
  });
});

// Aplicar filtros al hacer clic en filtro
btnFiltro.onclick = () => {
  const zonasSeleccionadas = Array.from(zona.selectedOptions).map(o => o.value);
  const puestosSeleccionados = Array.from(puesto.selectedOptions).map(o => o.value);

  if (zonasSeleccionadas.length > 0) {
    getEmpleados.zonas = zonasSeleccionadas;
  } else {
    delete getEmpleados.zonas;
  }

  if (puestosSeleccionados.length > 0) {
    getEmpleados.puestos = puestosSeleccionados;
  } else {
    delete getEmpleados.puestos;
  }

  if (fechas.value !== '') {
    getEmpleados.fechas = fechas.value;
  } else {
    delete getEmpleados.fechas;
  }

  getData(1, parseInt(inputLang.value));
};

// Mostrar barra de carga con progreso simulado
const showLoading = () => {
  loadingContainer.style.display = 'block';
  progressBar.style.width = '0%';
  progressBar.setAttribute('aria-valuenow', 0);

  let progreso = 0;
  return setInterval(() => {
    progreso += 10;
    if (progreso <= 90) {
      progressBar.style.width = `${progreso}%`;
      progressBar.setAttribute('aria-valuenow', progreso);
    }
  }, 100);
};

// Ocultar barra de carga
const hideLoading = (interval) => {
  clearInterval(interval);
  progressBar.style.width = '100%';
  progressBar.setAttribute('aria-valuenow', 100);
  setTimeout(() => {
    loadingContainer.style.display = 'none';
    progressBar.style.width = '0%';
  }, 300);
};

// Renderizar tabla con empleados
const renderTablaEmpleados = (lista = []) => {
  dataTable.innerHTML = lista.map(value => `
    <tr>
      <td>${value.id}</td>
      <td>${value.nombre}</td>
      <td>${value.curp}</td>
      <td>${value.fecha_ingreso}</td>
      <td>${value.puesto ? value.puesto:''}</td>
      <td>${value.zona ? value.zona:''}</td>
      <td id="estatus-${value.id}">${asignIcon(value.estatus)}</td>
      <td>
        <div class="dropdown" style="${value.estatus === "baja" ? 'display: none;' : ''}">
          <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="text-muted sr-only">Action</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="empleado/${value.id}">Editar</a>
            <button data-bs-toggle="button" class="dropdown-item btn" onclick='baja(${value.id}, "${value.nombre}")'>Baja</button>
            <button data-bs-toggle="button" class="dropdown-item btn" onclick='incidencia(${value.id}, "${value.nombre}")'>Incidencia</button>
          </div>
        </div>
      </td>
    </tr>
  `).join('');
};

const renderEmployeeButton = (value) => {
    // Solo genera el botón si el estatus no es 1226
    if (value.estatus !== 1226) {
        return `<button data-bs-toggle="button" class="dropdown-item btn" onclick='baja(${value.id}, "${value.nombre}")'>Baja</button>`;
    }
    return ''; // No genera nada si el estatus es 1226
}

const baja = (id, nombre) => {
  $('#defaultModal').modal('show');
  document.getElementById("empleadoModal").innerText = nombre;
  document.getElementById("id_empleado").value = id;
}

const incidencia = (id, nombre) => {
  $('#incidenciaModal').modal('show');
  document.getElementById("empleadoIncidenciaModal").innerText = nombre;
  document.getElementById("id_empleado_incidencia").value = id;
}

const confirmarBaja = async () => {

  // let nuevoEstatus = status === 'activo' ? 'inactivo' : 'activo';
  const formulario = document.querySelector('.needs-validation-baja');

  if (formulario.checkValidity()) {
    let data_json = {
      "action": 'activar',
      "id": document.getElementById("id_empleado").value,
      "status": 1226,
      "fecha_baja": document.getElementById("datetimesBaja").value ? document.getElementById("datetimesBaja").value : new Date().toISOString().split('T')[0],
      "finiquito": document.getElementById("finiquito").value,  
      "motivo_baja": document.getElementById("motivoBaja").value,
      "nota_baja": document.getElementById("notaBaja").value,
      // "status": status === 'activo' ? 1226 : 1225
    };
   
    try {
      const response = await fetch(API_BASE_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-API-KEY': window.env.API_KEY,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify(data_json)
      });
  
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
  
      const data = await response.json();
      
      Toast.fire({
        icon: "success",
        title: data.mensaje
      });
      formulario.reset();
      formulario.classList.remove('was-validated');
      const tdEstatus = document.getElementById(`estatus-${id}`);
      if (tdEstatus) {
        tdEstatus.innerHTML = asignIcon(nuevoEstatus); // <-- Usa el nuevo estatus para el ícono
      }
  
    } catch (error) {
      console.error('Error al obtener datos:', error);
    }
  }else{
    formulario.classList.add('was-validated');
  }
}


const confirmarIncidencia = async () => {

  const formulario = document.querySelector('.needs-validation-incidencia');  
}

const badgeClasses = {
  activo: 'badge-success',
  pendiente: 'badge-warning',
  baja: 'badge-danger',
  // otros estados si quieres...
};

const asignIcon = (status) => {
  const badgeClass = badgeClasses[status] || 'badge-secondary'; // clase por defecto
  return `<span class="badge badge-pill ${badgeClass}">${status}</span>`;
}

// Generar paginación con manejo para búsqueda o carga normal
const generarPaginacion = (totalItems, itemsPorPagina, paginaActual) => {
  const totalPaginas = Math.ceil(totalItems / itemsPorPagina);
  const ul = document.querySelector('.pagination');
  if (!ul) {
    console.error('No se encontró el elemento con la clase .pagination en el DOM.');
    return;
  }
  ul.innerHTML = '';

  // console.log("Total Items:", totalItems, "Items per Page:", itemsPorPagina, "Total Pages:", totalPaginas, "Current Page:", paginaActual);

  const crearLi = (label, pagina, disabled = false, active = false) => {
    const li = document.createElement('li');
    li.className = `page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}`;
    li.innerHTML = `<a class="page-link" href="#">${label}</a>`;
    if (!disabled) {
      li.addEventListener('click', e => {
        e.preventDefault();
        if (searchInput.value != '') {
          searchData(searchInput.value, itemsPorPagina, pagina);
        } else {
          getData(pagina, itemsPorPagina);
        }
      });
    }
    return li;
  };

  // Botón Anterior
  ul.appendChild(crearLi("«", paginaActual - 1, paginaActual === 1));

  // Botones numéricos de páginas
  for (let i = 1; i <= totalPaginas; i++) {
    ul.appendChild(crearLi(i, i, false, i === paginaActual));
  }

  // Botón Siguiente
  ul.appendChild(crearLi("»", paginaActual + 1, paginaActual === totalPaginas));
};

// Obtener datos con filtros y paginación
const getData = async (pagina = 1, items = parseInt(inputLang.value)) => {
  paginaActual = pagina;
  reload.disabled = true;
  reload.innerText = "Cargando...";

  getEmpleados.action = "getEmpleados";
  getEmpleados.pagina = pagina;
  getEmpleados.limit = items;

  const interval = showLoading();

  try {
    const response = await fetch(API_BASE_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-API-KEY': window.env.API_KEY,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(getEmpleados)
    });

    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

    const data = await response.json();

    renderTablaEmpleados(data?.empleado?.data || []);

    document.querySelector("#completado").innerText = data?.completados?.empleadosTotales ?? 0;
    document.querySelector("#bajas").innerText = data?.bajas?.empleadosTotales ?? 0;
    document.querySelector("#pendeintes").innerText = data?.pendientes?.empleadosTotales ?? 0;
    document.querySelector("#AllTotal").innerText = data?.AllTotal?.empleadosTotales ?? 0;
    document.querySelector("#total").innerText = data?.empleado?.total ?? 0;

    totalEmpleados = data?.empleado?.total ?? 0;
    generarPaginacion(totalEmpleados, items, pagina);

  } catch (error) {
    console.error('Error al obtener datos:', error);
  } finally {
    reload.disabled = false;
    reload.innerHTML = `<span class="fe fe-refresh-ccw fe-16 text-muted"></span>`;
    hideLoading(interval);
  }
};

// Buscar datos con paginación
const searchData = async (search, limit = 10, pagina = 1) => {
  const offset = (pagina - 1) * limit;
  const interval = showLoading();

  getEmpleados.action = "searchEmpleado";
  getEmpleados.search = search;
  getEmpleados.limit = limit;
  getEmpleados.offset = offset;

  try {
    const response = await fetch(API_BASE_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-API-KEY': window.env.API_KEY,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(getEmpleados)
    });

    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

    const data = await response.json();
    renderTablaEmpleados(data.data);
    document.querySelector("#total").innerText = data?.total ?? 0;

    generarPaginacion(data.total, limit, pagina);

  } catch (error) {
    console.error('Error en la búsqueda:', error);
  } finally {
    hideLoading(interval);
  }
};

// Eventos
reload.onclick = () => getData();
inputLang.onchange = () => getData(1, parseInt(inputLang.value));

let debounceTimer;
searchInput.onkeyup = () => {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(() => {
    const valor = searchInput.value.trim();
    if (valor.length > 0) {
      searchData(valor, parseInt(inputLang.value), 1);
    } else {
      getData(1, parseInt(inputLang.value));
    }
  }, 500);
};

btnReset.onclick = () => {
  searchInput.value = '';
  delete getEmpleados.search;
  getData(1, parseInt(inputLang.value));
};

// Carga inicial
getData();
