const QRContainer = document.getElementById("qrcode");
const timerSpan = document.getElementById("timer");
const duracionQR = 5 * 60 * 1000; // 5 minutos
let qr, expiracion;

// 🔹 Función para generar QR desde API
async function generarQR() {
  try {

    const usuarioStorage = JSON.parse(localStorage.getItem('user')); // si guardaste el JSON completo
    const idEmpleado = usuarioStorage?.usuario?.id || 0; // fallback 0 si no existe
    const data = {
        action: "getQr",
        id_empleado: idEmpleado
    };
    // Petición al servidor para obtener token
    const API_BASE_URL = window.env.API_URL + 'employees';
    
    const response = await fetch(API_BASE_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-API-KEY': window.env.API_KEY,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(data)
    });

    if (!response.ok) throw new Error('Error al obtener token');
    const result = await response.json();

    // El servidor debe devolver { token: "123-xxxx" }
    const token = result.qr_token;
    const url = `${token}`;

    // Limpiar QR anterior
    QRContainer.innerHTML = "";

    qr = new QRCode(QRContainer, {
      text: url,
      width: 200,
      height: 200,
      colorDark: "#000000",
      colorLight: "#ffffff"
    });

    expiracion = Date.now() + duracionQR;
    actualizarTemporizador();
    console.log("QR generado con:", url);

  } catch (error) {
    QRContainer.innerHTML = `<span style="color:red">❌ Error: ${error.message}</span>`;
    console.error(error);
  }
}

// 🔹 Temporizador visible
function actualizarTemporizador() {
  const intervalo = setInterval(() => {
    const ahora = Date.now();
    const restante = expiracion - ahora;

    if (restante <= 0) {
      clearInterval(intervalo);
      QRContainer.innerHTML = "<span style='color:red'>❌ QR caducado</span>";
      timerSpan.textContent = "";
      return; // No regeneramos
    }

    const min = Math.floor(restante / 60000);
    const seg = Math.floor((restante % 60000) / 1000);
    timerSpan.textContent = `Expira en: ${min}:${seg.toString().padStart(2,"0")}`;
  }, 1000);
}

// 🔹 Iniciar
generarQR();