 <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <h1>Captura de Entrada</h1>
             <div class="row mb-4 items-align-center">
                <div class="col-md-12 mb-4">
                  <div class="col-md-12 mb-4">
                    <div class="card shadow">
                      <div class="card-header text-center">
                        <strong class="card-title">Ingresa tu CURP o RFC</strong>
                      </div>
                      <div class="card-body">
                        <input class="form-control form-control-lg mt-5 mb-5" id="search" type="text" placeholder="CURP ó RFC" aria-label=".form-control-lg example">
                        <button type="button" class="btn btn-primary" id="btnSearch"><i class="fe fe-key fe-16"></i> Ingresar ...</button>
                        <p id="info" class="m-3"></p>
                        <div class="box">
                            <video id="video" autoplay muted></video>
                            <canvas id="canvas" style="display:none;"></canvas>

                            <div id="controls" style="display:none;">
                              <button class="btn btn-primary" id="btnLeer"><i class="fe fe-aperture fe-16"></i>  Leer rostro</button>
                              <p id="resultado" class="m-3">Resultado: -</p>
                            </div>
                        </div>

                      </div>
                      
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
      </div>
  </main>
