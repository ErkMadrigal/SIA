    const API_BASE_URL = window.env.API_URL + 'employees';
    
    const btnStart = document.getElementById("btnStart");
    const btnStop = document.getElementById("btnStop");
    const btnQR = document.getElementById("btnQR");
    const dataDiv = document.getElementById("data");
    let watchId = null;

    // 🔹 Calcular distancia (Haversine)
    function calcularDistancia(lat1, lon1, lat2, lon2) {
      const R = 6371e3; // metros
      const toRad = (deg) => (deg * Math.PI) / 180;
      const dLat = toRad(lat2 - lat1);
      const dLon = toRad(lon2 - lon1);
      const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
        Math.sin(dLon / 2) ** 2;
      return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    // 🔹 Obtener IP pública
    async function obtenerIP() {
      try {
        const res = await fetch("https://api.ipify.org?format=json");
        const data = await res.json();
        return data.ip;
      } catch (e) {
        return "No disponible";
      }
    }

    // 🔹 Iniciar seguimiento
    btnStart.addEventListener("click", async () => {
      if (!navigator.geolocation) {
        dataDiv.textContent = "❌ Geolocalización no soportada.";
        return;
      }

      dataDiv.textContent = "Obteniendo IP y ubicación...";
      const ip = await obtenerIP();

      navigator.geolocation.getCurrentPosition(
        (pos) => {
          const { latitude, longitude, accuracy } = pos.coords;
          dataDiv.innerHTML = `
            🌍 <b>Ubicación inicial:</b><br>
            Lat: ${latitude.toFixed(6)}<br>
            Lon: ${longitude.toFixed(6)}<br>
            Precisión: ${Math.round(accuracy)} m<br>
            🌐 IP: ${ip}<br><br>
            Iniciando seguimiento...`;

          iniciarSeguimiento(latitude, longitude, ip);
        },
        (err) => { dataDiv.textContent = "⚠️ Error: " + err.message; },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
      );
    });

    // 🔹 Seguimiento continuo
    function iniciarSeguimiento(latInicial, lonInicial, ip) {
      btnStart.disabled = true;
      btnStop.disabled = false;

      watchId = navigator.geolocation.watchPosition(
        (pos) => {
          const { latitude, longitude, accuracy } = pos.coords;
          const distancia = calcularDistancia(latInicial, lonInicial, latitude, longitude);

          dataDiv.innerHTML = `
            📡 <b>Seguimiento en tiempo real</b><br>
            Lat: ${latitude.toFixed(6)}<br>
            Lon: ${longitude.toFixed(6)}<br>
            Precisión: ${Math.round(accuracy)} m<br>
            🌐 IP: ${ip}<br>
            📏 Distancia desde inicio: ${distancia.toFixed(2)} m<br>
            🕒 Hora: ${new Date().toLocaleTimeString()}`;

          enviarDatos(latitude, longitude, ip);
        },
        (err) => dataDiv.textContent = "❌ Error: " + err.message,
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 5000 }
      );
    }

    // 🔹 Detener seguimiento
    btnStop.addEventListener("click", () => {
      if (watchId !== null) {
        navigator.geolocation.clearWatch(watchId);
        watchId = null;
        btnStart.disabled = false;
        btnStop.disabled = true;
        dataDiv.textContent = "🛑 Seguimiento detenido.";
      }
    });

    // 🔹 Enviar datos al servidor
    // async function enviarDatos(lat, lon, ip) {
    //   const datos = {
    //     id_empleado: 1,
    //     latitud: lat,
    //     longitud: lon,
    //     ip: ip
    //   };
    //   try {
    //     await fetch("guardar_asistencia.php", {
    //       method: "POST",
    //       headers: { "Content-Type": "application/json" },
    //       body: JSON.stringify(datos)
    //     });
    //   } catch (err) {
    //     console.error("Error al enviar:", err);
    //   }
    // }

    // 🔹 Escanear QR
    btnQR.addEventListener("click", () => {
      const readerDiv = document.getElementById("reader");
      readerDiv.style.display = "block";
      dataDiv.innerHTML = "📷 Escaneando QR...";

      const html5QrCode = new Html5Qrcode("reader");
      html5QrCode.start(
        { facingMode: "environment" }, // Cámara trasera
        { fps: 10, qrbox: 250 },
        (decodedText) => {
          html5QrCode.stop();
          readerDiv.style.display = "none";
          dataDiv.innerHTML = `✅ QR detectado:<br>${decodedText}`;

          const data = {
              action: "setQr",
              token: decodedText
          };

          // Enviar QR al servidor
          fetch(API_BASE_URL, {
            method: "POST",
            headers: {
              'Content-Type': 'application/json',
              'X-API-KEY': window.env.API_KEY,
              'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify(data)
          })
          .then(res => res.json())
          .then(data => {
            console.log(data)
            dataDiv.innerHTML += `<br><b>Servidor:</b> ${data.mensaje}`


          })
          .catch(err => console.error(err));
        }
      ).catch((err) => {
        dataDiv.textContent = "❌ Error iniciando cámara: " + err;
      });
    });