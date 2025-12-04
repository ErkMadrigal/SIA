// === Configuración general ===
const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
const buscador = document.getElementById('buscador'); // input de búsqueda
const localResults = document.getElementById("localResults");
const remoteResults = document.getElementById("remoteResults");

const loadingIndicator = document.querySelector(".DocSearch-LoadingIndicator");
const resetButton = document.querySelector(".DocSearch-Reset");

const datosLocales = [
  { nombre: "Configuración general", ruta: "configuracion" },
  { nombre: "Usuarios", ruta: "usuarios" },
  { nombre: "Panel de control", ruta: "dashboard" },
  { nombre: "Reportes", ruta: "reportes" },
  { nombre: "Preferencias del sistema", ruta: "preferencias" },
  { nombre: "Empleados", ruta: "empleados" },
  { nombre: "Home", ruta: "home" },
  { nombre: "Nuevo empleado", ruta: "nuevo-empleado" },
  { nombre: "Importaciones", ruta: "importaciones" },
  { nombre: "Carga masiva empleados", ruta: "carga-masiva-empleados" },
  { nombre: "Configuraciones", ruta: "configuraciones" },
  { nombre: "Actividades", ruta: "actividades" },
];

let dominio = window.location.origin

window.env = {
  // API_URL: "http://localhost/serprosep_interno/API/",
  API_URL: dominio+"/SIA/API/",
  URL: dominio+"/SIA/app/",
  API_KEY: "k8sd7f9a2v1b4mzqp0xlj5ngtu3wrceh",
  API: "a5da54250240419999df7a0dfa36cd3d"
};

// === Funciones ===
function openSearch() {
  searchModal.show();
  setTimeout(() => buscador.focus(), 500);
}

function closeSearch() {
  searchModal.hide();
  buscador.value = "";
  localResults.innerHTML = "";
  remoteResults.innerHTML = "";
  hideResetButton();
  hideLoadingSearch();
}

function showLoadingSearch() {
  loadingIndicator.style.display = "flex";
}

function hideLoadingSearch() {
  loadingIndicator.style.display = "none";
}

function showResetButton() {
  resetButton.hidden = false;
}

function hideResetButton() {
  resetButton.hidden = true;
}

function mostrarResultadosLocales(query) {
  console.log(query)
  searchDataMenu(query);


  const filtrados = datosLocales.filter(d =>
    d.nombre.toLowerCase().includes(query)
  );

  localResults.innerHTML = `<h6 class="px-2 text-muted">Menú</h6>`;


  if (filtrados.length === 0) {
    localResults.innerHTML += `<div class="text-muted px-2">Sin resultados...</div>`;
    return;
  }

  filtrados.forEach(({ nombre, ruta }) => {
    const link = document.createElement("a");
    link.className = "list-group-item list-group-item-action modal-search-result d-flex align-items-center gap-2";
    link.href = ruta;
    link.onclick = closeSearch;

    // Crear el ícono
    const icon = document.createElement("span");
    icon.className = "fe fe-24 fe-link mr-3";

    // Crear el texto
    const text = document.createElement("span");
    text.textContent = nombre;

    // Agregar ícono y texto al enlace
    link.appendChild(icon);
    link.appendChild(text);

    // Agregar el enlace al contenedor
    localResults.appendChild(link);
  });

}

async function searchDataMenu(search, limit = 50, pagina = 1) {
  const offset = (pagina - 1) * limit;

  const payload = {
    action: "searchEmpleado",
    search,
    limit,
    offset
  };

  showLoadingSearch();

  try {
    const response = await fetch(window.env.API_URL + "employees", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-API-KEY": window.env.API_KEY,
        "Authorization": `Bearer ${localStorage.getItem("token")}`
      },
      body: JSON.stringify(payload)
    });

    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

    const data = await response.json();
    console.log(data)


    remoteResults.innerHTML = `<h6 class="px-2 mt-3 text-muted">Empleados</h6>`;

    if (!data?.data?.length) {
      remoteResults.innerHTML += `<div class="text-muted px-2">Sin coincidencias...</div>`;
      return;
    }




    data.data.forEach(value => {
      const link = document.createElement("a");
      link.className = "list-group-item list-group-item-action modal-search-result d-flex align-items-center gap-2";
      link.href = `empleado/${value.id}`; // ajustar si es necesario
      link.onclick = closeSearch;

      // Ícono
      const icon = document.createElement("span");
      icon.className = "fe fe-24 fe-user mr-3";

      // Texto
      const text = document.createElement("span");
      text.textContent = value.nombre;

      // Ensamblar
      link.appendChild(icon);
      link.appendChild(text);
      remoteResults.appendChild(link);
    });

  } catch (error) {
    console.error("Error en la búsqueda:", error);
    remoteResults.innerHTML = `<div class="text-danger px-2">Error al buscar empleados</div>`;
  } finally {
    hideLoadingSearch();
  }
}

// === Eventos ===
document.addEventListener("keydown", e => {
  if (e.ctrlKey && e.key.toLowerCase() === "k") {
    e.preventDefault();
    openSearch();
  } else if (e.key === "Escape") {
    closeSearch();
  }
});

let debounceTimerSearch;

buscador.onkeyup = () => {

  const valor = buscador.value.trim().toLowerCase();
  localResults.innerHTML = "";
  remoteResults.innerHTML = "";
   clearTimeout(debounceTimerSearch);
  debounceTimerSearch = setTimeout(() => {
    if (valor.length > 0) {
      showResetButton();
      mostrarResultadosLocales(valor);
    } else {
      hideResetButton();
    }
  }, 500);
  
}

resetButton.addEventListener("click", () => {
  buscador.value = "";
  localResults.innerHTML = "";
  remoteResults.innerHTML = "";
  hideResetButton();
  buscador.focus();
});

// === Logout ===
document.querySelector('#logout').addEventListener('click', () => {
  document.cookie = "jwt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  localStorage.removeItem("token");
  localStorage.removeItem("user");
});

// === Toast config ===
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: toast => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
