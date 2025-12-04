 <main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
          <h2 class="h3 mb-4 page-title">Empleado</h2>
          <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="trabajo-tab" data-toggle="tab" href="#trabajo" role="tab" aria-controls="trabajo" aria-selected="false">Trabajo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="banco-tab" data-toggle="tab" href="#banco" role="tab" aria-controls="banco" aria-selected="false">Bancario</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="biometrico-tab" data-toggle="tab" href="#biometrico" role="tab" aria-controls="biometrico" aria-selected="false">Biometrico</a>
              </li>
            </ul>
            <div class="row mt-5 align-items-center">
              <!-- <div class="col-md-3 text-center mb-5">
                <div class="avatar avatar-xl">
                  <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
              </div> -->
              <div class="col">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <h4 class="mb-1" id="nombreCompleto"></h4>
                    <p class="small mb-3" ><span class="badge badge-dark" id="puestoElemento"></span></p>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <p class="small mb-0 text-muted" id="CURP"></p>
                    <p class="small mb-0 text-muted" id="RFC"></p>
                    <p class="small mb-0 text-muted" id="NSS"></p>
                  </div>
                </div>
              </div>
              <div class="col">
                  <img src="" alt="Foto Empleado" id="avatar" class="img-fluid rounded" style="width:8rem; display: none;">
              </div>
            </div>
            <hr class="my-4">
            
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                  <form class="needs-invalidation-personal" noinvalidate> 
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">Nombre (s) <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="nombre" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">Apellido Paterno <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="paterno" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">Apellido Materno <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="materno" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
  
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">CURP <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="curp" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">RFC <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="rfc" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">NSS <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="nss" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="Codigo postal">Codigo Postal Fiscal<strong
                                  class="text-danger">*</strong></label>
                          <input class="form-control input-code" type="text" id="cp"
                              autocomplete="off" maxlength="6" required>
                          <div class="invalid-feedback"> El campo es requerido </div>
                      </div>
                          
                    </div>
                    <button class="btn btn-primary btn-block" id="updatePersonal">Actualizar</button>
                  </form>  
                </div>
                <div class="tab-pane fade" id="trabajo" role="tabpanel" aria-labelledby="trabajo-tab">
                  <form class="needs-invalidation-trabajo" noinvalidate> 
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom4">Empresa <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="empresa" required>
                                <option selected disabled value="">Seleccione una empresa</option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom3">Unidad de negocio <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="unidadNegocio" required>
                                <option selected disabled value="">Seleccione una Unidad de negocio
                                </option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom4">Gerente Regional <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="regional" required>
                                <option selected disabled value="">Seleccione un Gerente Regional
                                </option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido</div>
    
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom4">Zona / Área </label>
                            <select class="form-control select2" id="zona">
                                <option selected disabled>Seleccione una Zona / Área</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom4">Servicio </label>
                            <input class="form-control" type="text" id="servicio" list="servicios">
                            <input type="hidden" id="servicioId">
                            <datalist id="servicios"></datalist>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom4">Turno <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="turno">
                                <option selected disabled value="">Seleccione un Turno</option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom3">Puesto <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="puesto">
                                <option selected disabled value="">Seleccione un Puesto</option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido</div>
    
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom3">Periocidad <strong
                                    class="text-danger">*</strong></label>
                            <select class="form-control select2" id="periocidad">
                                <option selected disabled value="">Seleccione un Periocidad</option>
                            </select>
                            <div class="invalid-feedback"> El campo es requerido</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invalidationCustom3">Sueldo <strong
                                    class="text-danger">*</strong></label>
                            <input type="number" class="form-control" id="sueldo" required>
                            <div class="invalid-feedback"> El campo es requerido</div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" id="updateTrabajo">Actualizar</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="banco" role="tabpanel" aria-labelledby="banco-tab">
                  <form class="needs-invalidation-banco" noinvalidate>
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">No. Cuenta</label>
                          <input type="text" class="form-control" id="cuenta">
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="invalidationCustom3">No. Clave Interbancaria <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="interbancaria"
                              autocomplete="off" maxlength="23" placeholder="____-____-____-____-__"
                              required>
                          <div class="invalid-feedback"> El campo es requerido</div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="Bancaria">Institución Bancaria <strong
                                  class="text-danger">*</strong></label>
                          <input type="text" class="form-control" id="institucionBancaria" required
                              disabled>
                          <input type="hidden" class="form-control" id="banco" required disabled>
                          <div class="invalid-feedback"> El campo es requerido</div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" id="updateBanco">Actualizar</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="biometrico" role="tabpanel" aria-labelledby="biometrico-tab">
                  <form class="needs-invalidation-biometrico" noinvalidate>
                    <div class="form-row">
                      <div class="col-md-6 mb-3">
                        <button class="btn btn-primary btn-block mt-3" id="btnFoto"><i class="fe fe-aperture fe-16"></i> Subir foto</button>
                        <input type="file" id="fotoEmpleado" accept="image/*" style="display: none;">
                      </div>
                      <div class="col-md-6"></div>
                      <div class="col-md-12 mb-3" style="width: 80%;">
                        <div id="fotoEmpleadoPreview" class="text-center">
                          <img src="" alt="Foto Empleado" id="fotoEmpleadoImg" class="img-fluid rounded" style="display: none;">
                        </div>

                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" id="updateFotos">Actualizar</button>
                  </form>
                </div>
              </div>
            

            
          </div> <!-- /.card-body -->
        </div> <!-- /.col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
        
</main> <!-- main -->