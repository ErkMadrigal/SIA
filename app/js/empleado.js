// Declarar id fuera de la IIFE
let id;
const API_BASE_URL_EMPLEADOS = window.env.API_URL + 'employees';


(async () => {

  const path = window.location.pathname; // "/serprosep_interno/frontEnd/empleado/5112"
  const partes = path.split("/"); // ["", "serprosep_interno", "frontEnd", "empleado", "5112"]
  id = partes[partes.length - 1]; // Asignar el valor a la variable global

  // Resto del código de la IIFE
  let nombreCompleto = document.querySelector("#nombreCompleto");
  let puestoElemento = document.querySelector("#puestoElemento");
  let CURP = document.querySelector("#CURP");
  let RFC = document.querySelector("#RFC");
  let NSS = document.querySelector("#NSS");

  let nombre = document.querySelector("#nombre");
  let paterno = document.querySelector("#paterno");
  let materno = document.querySelector("#materno");
  let curp = document.querySelector("#curp");
  let rfc = document.querySelector("#rfc");
  let nss = document.querySelector("#nss");
  let cp = document.querySelector("#cp");

  let empresa = document.querySelector("#empresa");
  let unidadNegocio = document.querySelector("#unidadNegocio");
  let regional = document.querySelector("#regional");
  let zona = document.querySelector("#zona");
  let servicioId = document.querySelector("#servicioId");
  let turno = document.querySelector("#turno");
  let puesto = document.querySelector("#puesto");
  let periocidad = document.querySelector("#periocidad");
  let sueldo = document.querySelector("#sueldo");

  let cuenta = document.querySelector("#cuenta");
  let interbancaria = document.querySelector("#interbancaria");
  let banco = document.querySelector("#banco"); 
  let institucionBancaria = document.querySelector("#institucionBancaria");


  let avatar = document.querySelector("#avatar");

  let data_json = {
    "action": "getEmpleado",
    "id_empleado": id
  };

  try {
    const response = await fetch(API_BASE_URL_EMPLEADOS, {
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
    let usr = data.data;

    console.log(usr);
    nombreCompleto.innerText = usr.nombreCompleto;
    puestoElemento.innerText = usr.puesto ? usr.puesto : '';
    CURP.innerText = "CURP " + (usr.curp ? usr.curp : '');
    RFC.innerText = "RFC " + (usr.rfc ? usr.rfc : '');
    NSS.innerText = "NSS " + (usr.nss ? usr.nss : '');
    if(usr.fotos != null && usr.fotos != ""){
      avatar.style.display = "block";
      avatar.src = window.env.URL + "photos/" + usr.fotos;
    }

    nombre.value = usr.nombre;
    paterno.value = usr.paterno;
    materno.value = usr.materno;
    curp.value = usr.curp;
    rfc.value = usr.rfc;
    nss.value = usr.nss;
    cp.value = usr.CP_fiscal;

    document.querySelector("#trabajo-tab").onclick = () => {
      empresa.value = usr.id_empresa ? usr.id_empresa : '';
      unidadNegocio.value = usr.id_unidad_negocio ? usr.id_unidad_negocio : '';
      regional.value = usr.id_regional ? usr.id_regional : '';
      zona.value = usr.id_zona ? usr.id_zona : '';
      servicioId.value = usr.id_servicio ? usr.id_servicio : '';
      turno.value = usr.id_turno ? usr.id_turno : '';
      puesto.value = usr.id_puesto ? usr.id_puesto : '';
      periocidad.value = usr.id_periocidad ? usr.id_periocidad : '';
      sueldo.value = usr.sueldo ? usr.sueldo : '';
    };

    document.querySelector("#banco-tab").onclick = () => {
      interbancaria.value = usr.clave_interbancaria ? usr.clave_interbancaria : '';
      cuenta.value = usr.cuenta ? usr.cuenta : '';
      banco.value = usr.id_banco ? usr.id_banco : '';
      institucionBancaria.value = usr.institucionBancaria ? usr.institucionBancaria : '';
    };
  } catch (error) {
    console.error('Error al obtener datos:', error);
  }
})();

// Seleccionar el formulario
let formulario = document.querySelector(".needs-invalidation-personal");

const personal = async (event) => {
  // Prevenir el comportamiento predeterminado del formulario
  event.preventDefault();

  // Verificar que el formulario exista
  if (!formulario) {
    console.error('Formulario .needs-invalidation-personal no encontrado');
    Toast.fire({
      icon: "error",
      title: "Error",
      text: "Formulario no encontrado"
    });
    return;
  }

  // Validar el formulario
  if (formulario.checkValidity()) {
    let data_json = {
      action: "actualizarEmpleado",
      tipo: "personal",
      id: id, // Ahora id está definido en el ámbito global
      nombre: nombre.value,
      paterno: paterno.value,
      materno: materno.value,
      curp: curp.value,
      rfc: rfc.value,
      nss: nss.value,
      cp: cp.value
    };

    try {
      const response = await fetch(API_BASE_URL_EMPLEADOS, {
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
      if (data.status === "ok") {
        Toast.fire({
          icon: "success",
          title: data.mensaje
        });
      } else {
        Toast.fire({
          icon: "error",
          title: data.mensaje
        });
      }
    } catch (error) {
      console.error('Error al obtener datos:', error);
    }
  } else {
    formulario.classList.add('was-validated');
  }
};

// Asegúrate de que el evento esté correctamente asociado
document.querySelector("#updatePersonal").addEventListener("click", personal);

let formularioTrabajo = document.querySelector(".needs-invalidation-trabajo");


const trabajo = async (event) => {
    // Prevenir el comportamiento predeterminado del formulario
    event.preventDefault();
    
    // Verificar que el formulario exista
    if (!formularioTrabajo) {
        console.error('Formulario .needs-invalidation-trabajo no encontrado');
        Toast.fire({
            icon: "error",
            title: "Error",
            text: "Formulario no encontrado"
        });
        return;
    }
    
    // Validar el formulario
    if (formularioTrabajo.checkValidity()) {
        let data_json = {
            action: "actualizarEmpleado",
            tipo: "trabajo",
            id: id, // Ahora id está definido en el ámbito global
            id_unidad_negocio: unidadNegocio.value,
            id_regional: regional.value,
            id_zona: zona.value,
            id_empresa: empresa.value,
            id_servicio: servicioId.value,
            id_turno: turno.value,
            id_puesto: puesto.value,
            sueldo: sueldo.value,
            id_periocidad: periocidad.value
        };
    
        try {
        const response = await fetch(API_BASE_URL_EMPLEADOS, {
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
        if (data.status === "ok") {
            Toast.fire({
                icon: "success",
                title: data.mensaje
            });
        } else {
            Toast.fire({
                icon: "error",
                title: data.mensaje
            });
        }
        } catch (error) {
        console.error('Error al obtener datos:', error);
        }
    } else {
        formularioTrabajo.classList.add('was-validated');
    }

}

document.querySelector("#updateTrabajo").addEventListener("click", trabajo);

let formularioBanco = document.querySelector(".needs-invalidation-banco");


const bancario = async (event) => {
    // Prevenir el comportamiento predeterminado del formulario
    event.preventDefault();
    
    // Verificar que el formulario exista
    if (!formularioBanco) {
        console.error('Formulario .needs-invalidation-banco no encontrado');
        Toast.fire({
            icon: "error",
            title: "Error",
            text: "Formulario no encontrado"
        });
        return;
    }
    
    // Validar el formulario
    if (formularioBanco.checkValidity()) {
        let data_json = {
            action: "actualizarEmpleado",
            tipo: "banco",
            id: id, // Ahora id está definido en el ámbito global
            cuenta: cuenta.value,
            clave_interbancaria: interbancaria.value,
            id_banco: document.querySelector("#banco").value
        };
    
        try {
        const response = await fetch(API_BASE_URL_EMPLEADOS, {
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
        if (data.status === "ok") {
            Toast.fire({
                icon: "success",
                title: data.mensaje
            });
        } else {
            Toast.fire({
                icon: "error",
                title: data.mensaje
            });
        }
        } catch (error) {
            console.error('Error al obtener datos:', error);
        }
    } else {
        formularioBanco.classList.add('was-validated');
    }
}

document.querySelector("#updateBanco").addEventListener("click", bancario);

document.querySelector("#btnFoto").onclick = async (e) => {
  e.preventDefault();
  e.stopPropagation(); 
  document.querySelector("#fotoEmpleado").click();
};


document.querySelector("#fotoEmpleado").addEventListener("change", function () {
  const file = this.files[0];
  const previewImg = document.querySelector("#fotoEmpleadoImg");

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      previewImg.src = e.target.result;
      previewImg.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

document.querySelector("#updateFotos").onclick = async (e) => {
  e.preventDefault();
  e.stopPropagation();

  const fileInput = document.querySelector("#fotoEmpleado");
  const file = fileInput.files[0];
  if (!file){
    Swal.fire({
        title: "Es requerida una foto",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Cerrar",
        timer: 2000
    })
  } 

  // 📌 Generar nombre automático
  const now = new Date();
  const fecha = now.getFullYear()
    + String(now.getMonth() + 1).padStart(2, "0")
    + String(now.getDate()).padStart(2, "0")
    + "_" 
    + String(now.getHours()).padStart(2, "0")
    + String(now.getMinutes()).padStart(2, "0")
    + String(now.getSeconds()).padStart(2, "0");

  const newFileName = `${fecha}.jpg`;

  console.log(file)
  let data_json = {
      action: "updatePhoto",
      foto: file,
      id, // Ahora id está definido en el ámbito global
      nombreFoto: newFileName,
  };

  const formData = new FormData();
  formData.append("action", "updatePhoto");
  formData.append("foto", file);
  formData.append("id_empleado", id);
  formData.append("nombreFoto", newFileName);
    
  try {
    const response = await fetch(API_BASE_URL_EMPLEADOS, {
      method: 'POST',
      headers: {
        // 'Content-Type': 'application/json',
        'X-API-KEY': window.env.API_KEY,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      // body: JSON.stringify(data_json)
      body: formData
    });
    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    const data = await response.json();

    Swal.fire({
        title: data.message,
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Cerrar",
        timer: 3000
    }).then((res) => {
        if (res.isConfirmed) {
            window.location.reload();
        }
    });

    setTimeout(() => {
        window.location.reload();
    }, 3000);

  }catch (error) {
    console.error('Error al obtener datos:', error);
  }
  
}