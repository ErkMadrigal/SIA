
  <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <h1>Captura de Asistencia</h1>
             <div class="row mb-4 items-align-center">
                <div class="col-md-12 mb-4">
                  <div class="card shadow">
                    <div class="card-header">
                      <strong class="card-title">Captura la Curp o Número de Empleado</strong>
                    </div>
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <input class="form-control form-control-lg" type="text" placeholder="Curp o Número de Empleado" id="inputCurpNumEmp">
                        </div> -->
                        <div class="form-group">
                           <button id="btnStart">Iniciar seguimiento</button>
                            <button id="btnStop" disabled>Detener seguimiento</button>
                            <button id="btnQR">📷 Escanear QR</button>

                            <div id="reader" style="display:none;"></div>
                            <div id="data"></div>
                        </div>
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
      </div>
  </main>
