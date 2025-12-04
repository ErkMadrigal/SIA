// =====================================================
// CONFIG
// =====================================================
const API_TOKEN = window.env.API;
const id_empleado = null;

let fotoEmpleadoBlob = null;    // Foto del empleado
let fotoCompararBlob = null;    // Foto del usuario desde cámara
let camaraActiva = false;

// =====================================================
// Convertir imagen URL → Blob
// =====================================================
async function urlToBlob(url){
    const res = await fetch(url);
    return await res.blob();
}

// =====================================================
// Comparación con Luxand
// =====================================================
function similarity(face1, face2){
    const headers = new Headers();
    headers.append("token", API_TOKEN);

    const form = new FormData();
    form.append("face1", face1, "file");
    form.append("face2", face2, "file");

    return fetch("https://api.luxand.cloud/photo/similarity", {
        method:"POST",
        headers,
        body: form
    }).then(r => r.json());
}

// =====================================================
// Activar cámara solo en memoria
// =====================================================
async function iniciarCamara(){
    if(camaraActiva) return;

    const video = document.getElementById("video");
    const stream = await navigator.mediaDevices.getUserMedia({ video:true });
    video.srcObject = stream;
    camaraActiva = true;
}

// =====================================================
// Capturar foto desde cámara sin mostrar
// =====================================================
async function capturarFoto(){
    await iniciarCamara();

    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");

    canvas.width = video.videoWidth || 350;
    canvas.height = video.videoHeight || 260;

    const ctx = canvas.getContext("2d");
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    return new Promise(resolve => canvas.toBlob(resolve, "image/jpeg"));
}

// =====================================================
// BUSCAR EMPLEADO Y ACTIVAR CÁMARA
// =====================================================
const btnSearch = document.getElementById("btnSearch");
const inputSearch = document.getElementById("search");

btnSearch.onclick = async () => {
    let query = inputSearch.value.trim();
    if(!query) return;

    const payload = { action: "getEmpleadoBiometrico", query, salida: true };

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

        if(!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const json = await response.json();

        // Validar si se encontró empleado
        if(!json.data || json.data.length === 0){
            document.getElementById("info").innerText = json.message || "Empleado no encontrado.";
            Swal.fire({
                title: json.message || "Empleado no encontrado.",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Cerrar",
                timer: 2000
            });
            fotoEmpleadoBlob = null;
            return;
        }

        const empleado = json.data[0];

        document.getElementById("controls").style.display = 'block';

        document.getElementById("info").innerText =
            `Empleado: ${empleado.nombreCompleto} - ${empleado.no_empleado}`;

        // Descargar foto del empleado en memoria
        const urlFoto = window.env.URL + "photos/" + empleado.fotos;
        this.id_empleado = empleado.id;
        fotoEmpleadoBlob = await urlToBlob(urlFoto);


        // Activar cámara automáticamente
        await iniciarCamara();
        console.log("Cámara activada para capturar rostro");

    } catch(error){
        console.error("Error al buscar empleado:", error);
    }
};

// =====================================================
// COMPARAR rostro sin mostrar
// =====================================================
document.getElementById("btnLeer").addEventListener("click", async () => {
    const resultado = document.getElementById("resultado");

    if(!fotoEmpleadoBlob){
        resultado.innerText = "Primero busca un empleado.";
        return;
    }

    // Capturar foto desde cámara
    fotoCompararBlob = await capturarFoto();

    // Comparar usando Luxand
    const res = await similarity(fotoEmpleadoBlob, fotoCompararBlob);

    resultado.innerText = '';
    if(res && res.score !== undefined){
        if(res.score.toFixed(4) >= 0.8999 && res.similar){
            // resultado.innerText = `Registro de entrada exitoso. `;
            asignarEntrada();
        }else{
            resultado.innerText = `<b>Rostro no coincide. Acceso denegado.<b>`;
        }
    } else {
        resultado.innerText = "Error al comparar rostros.";
    }
});

const API_BASE_URL = window.env.API_URL + 'employees';

const asignarEntrada = async () => {

    const ip = await obtenerIP();
    let id_empleado = this.id_empleado;

    // Primero creamos los datos base
    const data = {
        action: "registroEmpleadoBiometrico",
        ip,
        id_empleado,
        salida: true
    };

    // Convertimos geolocalización en Promesa para esperar los datos
    const getGeo = () => {
        return new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(
                pos => resolve(pos.coords),
                err => reject(err),
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        });
    };

    try {
        // Esperamos la ubicación
        const coords = await getGeo();

        data.lat = coords.latitude;
        data.lon = coords.longitude;

        console.log("DATA FINAL ANTES DE ENVIAR:", data);

        // Enviar QR al servidor
        const response = await fetch(API_BASE_URL, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-API-KEY': window.env.API_KEY,
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        Swal.fire({
            title: result.mensaje,
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Cerrar",
            timer: 2000
        }).then((res) => {
            if (res.isConfirmed) {
                window.location.reload();
            }
        });

        document.getElementById("resultado").innerHTML += `<b> ${result.mensaje} </b>`;

    } catch (err) {
        console.error("Error:", err);
        dataDiv.textContent = "⚠️ Error: " + err.message;
    } finally {
        setTimeout(() => {
            window.location.reload();
        }, 2000);
    }
};


async function obtenerIP() {
    try {
        const res = await fetch("https://api.ipify.org?format=json");
        const data = await res.json();
        return data.ip;
    } catch (e) {
       return "No disponible";
    }
}