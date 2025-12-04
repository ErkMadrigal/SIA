 <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto text-muted">
          <button type="button" class="btn btn-outline-secondary btn-lg" onclick="openSearch()" ><i class="fe fe-search fe-16"></i> Buscar (Ctrl + K)</button>
        </form>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-grid fe-16"></span>
            </a>
          </li>
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link my-2 text-primary" href="auth" id="logout">
              <span class="fe fe-log-out fe-16"></span>
            </a>
          </li>
         
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#"><i class="fe fe-user fe-16"></i> Perfil </a></li>
              <li><hr class="dropdown-divider"></li>
              <li class="text-center"><a class="dropdown-item text-primary" href="auth" id="logout"><i class="fe fe-log-out fe-16"></i> Cerrar sesión</a></li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="home">
              <img src="assets/images/favicon.ico" alt="logo" class="navbar-brand-img brand-md">
              <!-- <span class="text-muted">Serprosep</span> -->
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="home">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Home</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Empleados</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Empleados</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="empleados">
                    <i class="fe fe-user-check fe-16"></i>

                    <span class="ml-1 item-text">Ver Empleados</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="nuevo-empleado">
                    <i class="fe fe-user-plus fe-16"></i>

                    <span class="ml-1 item-text">Nuevo Empleado</span>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link pl-3" href="incidencias">
                    <i class="fe fe-file-text fe-16"></i>
                  <span class="ml-1 item-text">Incidencias</span></a>
                </li> -->
                
              </ul>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="colaborador">
                <i class="fe fe-user-plus fe-16"></i>
                <span class="ml-3 item-text">Colaborador</span>
                <span class="badge badge-pill badge-primary">New</span>
              </a>
            </li>
          </ul>
           <p class="text-muted nav-heading mt-4 mb-1">
            <span>Asistencias</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="asistencia" class="nav-link">
                <i class="fe fe-navigation-2 fe-16"></i>
                <span class="ml-3 item-text">Capturar</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="generar-QR" class="nav-link">
                <i class="fe fe-code fe-16"></i>
                <span class="ml-3 item-text">Generar QR</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="entrada-Biometrico" class="nav-link">
                <i class="fe fe-aperture fe-16"></i>
                <span class="ml-3 item-text">Entrada Biometrico</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="salida-Biometrico" class="nav-link">
                <i class="fe fe-aperture fe-16"></i>
                <span class="ml-3 item-text">Salida Biometrico</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="registrar-Biometrico" class="nav-link">
                <i class="fe fe-aperture fe-16"></i>
                <span class="ml-3 item-text">Registrar Biometrico</span>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
      <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="defaultModalLabel">Notificaciones</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="list-group list-group-flush my-n3">
                <div class="list-group-item bg-transparent">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="fe fe-box fe-24"></span>
                    </div>
                    <div class="col">
                      <small><strong>Package has uploaded successfull</strong></small>
                      <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                      <small class="badge badge-pill badge-light text-muted">1m ago</small>
                    </div>
                  </div>
                </div>
                <div class="list-group-item bg-transparent">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="fe fe-download fe-24"></span>
                    </div>
                    <div class="col">
                      <small><strong>Widgets are updated successfull</strong></small>
                      <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                      <small class="badge badge-pill badge-light text-muted">2m ago</small>
                    </div>
                  </div>
                </div>
                <div class="list-group-item bg-transparent">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="fe fe-inbox fe-24"></span>
                    </div>
                    <div class="col">
                      <small><strong>Notifications have been sent</strong></small>
                      <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                      <small class="badge badge-pill badge-light text-muted">30m ago</small>
                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="list-group-item bg-transparent">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="fe fe-link fe-24"></span>
                    </div>
                    <div class="col">
                      <small><strong>Link was attached to menu</strong></small>
                      <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                      <small class="badge badge-pill badge-light text-muted">1h ago</small>
                    </div>
                  </div>
                </div> <!-- / .row -->
              </div> <!-- / .list-group -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Borrar todo </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="defaultModalLabel">Metodos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body px-5">
              <div class="row align-items-center">
                <div class="col-6 text-center">
                  <div class="squircle bg-success justify-content-center">
                    <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                  </div>
                  <p>Control area</p>
                </div>
                <div class="col-6 text-center">
                  <a class="nav-link pl-3" href="actividades">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Actividades</p>
                  </div>
                  </a>
              </div>
              <div class="row align-items-center">
                <div class="col-6 text-center">
                  <div class="squircle bg-primary justify-content-center">
                    <i class="fe fe-download-cloud fe-32 align-self-center text-white"></i>
                  </div>
                  <p>Exportaciones</p>
                </div>
                <div class="col-6 text-center">
                  <a class="nav-link pl-3" href="importaciones">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Importaciones</p>
                  </a>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-6 text-center">
                  <div class="squircle bg-primary justify-content-center">
                    <i class="fe fe-users fe-32 align-self-center text-white"></i>
                  </div>
                  <p>Usuarios</p>
                </div>
                <div class="col-6 text-center">
                  <a class="nav-link pl-3" href="configuraciones">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Configuración</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <form class="DocSearch-Form">
                <!-- Icono de lupa -->
                <label for="docsearch-input" id="docsearch-label" class="DocSearch-MagnifierLabel">
                  <svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" class="DocSearch-Search-Icon">
                    <path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z"
                      stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                  </svg>
                  <span class="DocSearch-VisuallyHiddenForAccessibility">Buscar</span>
                </label>

                <!-- Indicador de carga (opcional) -->
                <div class="DocSearch-LoadingIndicator">
                  <svg viewBox="0 0 38 38" stroke="currentColor" stroke-opacity=".5">
                    <g fill="none" fill-rule="evenodd">
                      <g transform="translate(1 1)" stroke-width="2">
                        <circle stroke-opacity=".3" cx="18" cy="18" r="18"></circle>
                        <path d="M36 18c0-9.94-8.06-18-18-18">
                          <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                            dur="1s" repeatCount="indefinite" />
                        </path>
                      </g>
                    </g>
                  </svg>
                </div>

                <!-- Input de búsqueda -->
                <input
                  aria-autocomplete="both"
                  aria-labelledby="docsearch-label"
                  id="buscador"
                  class="DocSearch-Input"
                  type="search"
                  placeholder="Buscar..."
                  autocomplete="off"
                  autocorrect="off"
                  autocapitalize="off"
                  enterkeyhint="search"
                  spellcheck="false"
                  maxlength="64"
                >

                <!-- Botón para limpiar -->
                <button type="reset" title="Limpiar búsqueda" aria-label="Limpiar búsqueda" class="DocSearch-Reset" hidden>
                  <svg width="20" height="20" viewBox="0 0 20 20">
                    <path d="M10 10l5.09-5.09L10 10l5.09 5.09L10 10zm0 0L4.91 4.91 10 10l-5.09 5.09L10 10z"
                      stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                  </svg>
                </button>
              </form>
            </div>
            <div class="modal-body" id="searchResults">
                <div id="localResults" class="mb-5"></div>
                <hr>
                <div class="mt-5" id="remoteResults"></div>
            </div>
          </div>
        </div>
      </div>