<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="h3 mb-3 page-title">Empleados</h2>
        <div class="row mb-4 items-align-center">
          <div class="col-md">
            <ul class="nav nav-pills justify-content-start">
              <li class="nav-item">
                <p class="nav-link active bg-transparent pr-2 pl-0 text-primary">| Cantidad Total <span class="badge badge-pill bg-primary text-white ml-2" id="AllTotal"></span></p>
              </li>
              <li class="nav-item">
                <p class="nav-link text-muted px-2">| Completados <span class="badge badge-pill bg-success text-white " id="completado"></span></p>
              </li>
              <li class="nav-item">
                <p class="nav-link text-muted px-2">| Pendientes <span class="badge badge-pill bg-success text-white " id="pendeintes"></span></p>
              </li>
              <li class="nav-item">
                <p class="nav-link text-muted px-2">| Bajas <span class="badge badge-pill badge-danger" id="bajas"></span></p>
              </li>
            </ul>
          </div>
          <div class="form-group">
            <label for="inputLang">Registros Visibles</label>
            <select id="inputLang" class="form-control">
              <!-- <option value="2">2</option> -->
              <!-- <option value="5">5</option> -->
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
          <div class="col-md-auto ml-auto text-right">
            <!-- <span class="small bg-white border py-1 px-2 rounded mr-2 d-none d-lg-inline">
              <a href="#" class="text-muted"><i class="fe fe-x mx-1"></i></a>
              <span class="text-muted">Status : <strong>Pending</strong></span>
            </span>
            <span class="small bg-white border py-1 px-2 rounded mr-2 d-none d-lg-inline">
              <a href="#" class="text-muted"><i class="fe fe-x mx-1"></i></a>
              <span class="text-muted">April 14, 2020 - May 13, 2020</span>
            </span> -->
            
            <button type="button" class="btn" data-toggle="modal" data-target=".modal-employes"><span class="fe fe-filter fe-16 text-muted"></span></button>
            <button type="button" class="btn" id="reload"></button>
          </div>
        </div>
        <!-- Slide Modal -->
        <div class="modal fade modal-slide modal-employes" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Filtros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fe fe-x fe-12"></i>
                </button>
              </div>
              <div class="modal-body">
                <div class="p-2">
                  <div class="form-group my-4">
                    <p class="mb-2"><strong>Zona</strong></p>
                    <label for="multi-select2" class="sr-only"></label>
                    <select class="form-control select2-multi" multiple id="zona">
                      
                    </select>
                  </div> <!-- form-group -->
                  <div class="form-group my-4">
                    <p class="mb-2">
                      <strong>Estatus</strong>
                    </p>
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" value="1225" id="radioActivos" name="estatusRadio">
                      <label class="custom-control-label" for="radioActivos">Activos</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" value="1320" id="radioPendientes" name="estatusRadio">
                      <label class="custom-control-label" for="radioPendientes">Pendientes</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" value="1226" id="radioBajas" name="estatusRadio">
                      <label class="custom-control-label" for="radioBajas">Bajas</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" value="000" id="radioTodos" name="estatusRadio">
                      <label class="custom-control-label" for="radioTodos">Todos</label>
                    </div>
                  </div> <!-- form-group -->
                  <div class="form-group my-4">
                    <p class="mb-2"><strong>Puesto</strong></p>
                    <label for="multi-select2" class="sr-only"></label>
                    <select class="form-control select2-multi" multiple id="puesto">
                      
                    </select>
                  </div> <!-- form-group -->
                  <div class="form-group my-4">
                    <label for="date-input1">Rango de Fechas</label>
                    <input type="text" name="datetimes" class="form-control datetimes" id="fechas"/>

                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-primary btn-block" id="btnFiltro">Aplicar Filtros</button>
                <button type="button" class="btn mb-2 btn-secondary btn-block" id="btnRecargar">Borrar Filtros</button>
              </div>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Buscar Empleados" id="search" aria-label="Buscar Empleados">
          <div class="input-group-append">
            <button class="btn btn-danger" type="button" id="btnReset">
                <i class="fe fe-trash align-self-center text-white"></i>
            </button>
          </div>
        </div>
        <div id="loadingContainer" style="display: none;">
          <p class="mb-1"><strong>Cargando...</strong></p>
          <div class="progress mb-3">
            <div id="progressBar" class="progress-bar" role="progressbar"
                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
        </div>
        <p class="nav-link active bg-transparent pr-2 pl-0 text-primary">| Cantidad mostrada <span class="badge badge-pill bg-primary text-white ml-2" id="total"></span></p>
        <table class="table table-hover bg-white">
          <thead>
            <tr role="row">
              <th>ID</th>
              <th>Nombre</th>
              <th>CRUP</th>
              <th>Ingreso</th>
              <th>Puesto</th>
              <th>Zona</th>
              <th>Estatus</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="dataTable">
          </tbody>
        </table>
        <nav aria-label="Table Paging" class="my-3">
          <ul class="pagination justify-content-end mb-0">
          </ul>
        </nav>
      </div>
    </div> <!-- .row -->
  </div> <!-- .container-fluid --><!-- .container-fluid -->

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <form class="needs-validation-baja" novalidate>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="empleadoModal"></h5>
              <input type="hidden" name="id_empleado" id="id_empleado">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body row">
                <div class='col-12 col-sm-12 col-md-6'>
                    <div class="form-group">
                        <label for="finiquito" class=" control-label">Fecha efectiva de la baja:<span class="text-danger">*</span></label>
                        <input type="text" name="datetimesBaja" class="form-control datetimes" id="datetimesBaja"/>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-6'>
                    <div class="form-group">
                        <label for="finiquito" class=" control-label">Finiquito:<span class="text-danger">*</span></label>
                        <select class="form-control" id="finiquito" name="finiquito" required>
                            <option value="">Selecciona una Opcion</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>                
                        </select>
                        <div class="invalid-feedback"> El campo es requerido </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12'>
                    <div class="form-group">
                        <label for="motivo" class=" control-label">Motivo de baja:<span class="text-danger">*</span></label>
                        <select class="form-control" id="motivoBaja" name="motivoBaja" required>
                            <option value="">Selecciona una Opcion</option>
                                          
                        </select>
                        <div class="invalid-feedback"> El campo es requerido </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12'>
                    <div class="form-group">
                        <label for="notaBaja" class=" control-label">Nota:</label>
                        <textarea type="text" class="form-control " id="notaBaja" name="notaBaja"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn mb-2 btn-primary" onclick="confirmarBaja()">Procesar Baja</button>
            </div>
          </div>
        </div>
      </form> 

    </div>

</main