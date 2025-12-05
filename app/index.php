
<?php
   

    // Root
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $root = $protocol . $_SERVER["HTTP_HOST"] . "/SIA/app/";

    // Includes
    include './jwt/verify_jwt.php';

    $ruta = './views/';

    $publicas = ['auth', 'index', 'login']; // rutas públicas
    $url = isset($_GET['dir']) ? $_GET['dir'] : 'index';

    // Verificar JWT si no es ruta pública
    if (!in_array($url, $publicas)) {
        if (!isset($_COOKIE['jwt']) || !verificarToken($_COOKIE['jwt'])) {
            header("Location: {$root}login");
            exit;
        }
    }



    switch ($url) {
      
        case 'auth':
        case 'login':
        case 'index':
            $title = "auth";
            include "$ruta/auth/auth.php";
            
        break;

        case 'home':
            $title = "Home";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/home/home.php";
            $scripts = [];
            include "./components/footer.php";
        break;

        case 'empleados':
            $title = "Empleados";
            $links = ['css/select2.css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/empleados/empleados.php";
            $scripts = ['https://cdn.jsdelivr.net/npm/flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js', 'js/jquery.mask.min.js','js/select2.min.js', 'js/table-users.js', 'js/getUsers.js', 'js/filtros.js'];
            include "./components/footer.php";
        break;

        case 'empleado':
            $title = "Empleado";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/empleados/empleado.php";
            $scripts = [ 'js/getCatalogos.js', 'js/empleado.js'];
            include "./components/footer.php";
        break;

        case 'nuevo-empleado':
            $title = "Nuevo Empleado";
            $links = ['css/select2.css'];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/empleados/nuevo-empleado.php";
            $scripts = ['js/jquery.mask.min.js','js/select2.min.js', 'js/nuevo-empleado.js', 'js/getCatalogos.js'];
            include "./components/footer.php";
        break;

        case 'importaciones':
            $title = "Importaciones";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/imports/importaciones.php";
            $scripts = [];
            include "./components/footer.php";
        break;

        case 'editarUsuarios':
            $title = "Editar Usuarios";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/imports/editarUsuarios.php";
            $scripts = ['js/edicionMasiva.js'];
            include "./components/footer.php";
        break;

        case 'carga-masiva-empleados':
            $title = "Carga Masiva Empleados";
            $links = ["css/dropzone.min.css", "css/dropZone_xslx.css"];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/imports/carga-masiva-empleados.php";
            $scripts = ['js/dropzone.min.js', 'js/xlsx.full.min.js', 'js/dropzone.js'];
            include "./components/footer.php";
        break;

        case 'configuraciones':
            $title = "configuraciones";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/conf/configuraciones.php";
            $scripts = [];
            include "./components/footer.php";
        break;

        case 'actividades':
            $title = "actividades";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/activities/activities.php";
            $scripts = [];
            include "./components/footer.php";
        break;

        case 'colaborador':
            $title = "colaborador";
            $links = [];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/users/users.php";
            $scripts = ['js/users.js'];
            include "./components/footer.php";
        break;

        case 'multicatalogo':
            $title = "multicatalogo";
            $links = ['css/select2.css'];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/conf/multicatalogo.php";
            $scripts = ['js/select2.min.js', 'js/multicatalogo.js'];
            include "./components/footer.php";
        break;

        case 'asistencia':
            $title = "asistencia";
            $links = [''];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/asistencia/capturar.php";
            $scripts = ['https://unpkg.com/html5-qrcode','js/asistencias.js'];
            include "./components/footer.php";
        break;

        case 'generar-QR':
            $title = "generar-QR";
            $links = [''];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/asistencia/genQr.php";
            $scripts = ['https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js','js/qr.js'];
            include "./components/footer.php";
        break;

        case 'entrada-Biometrico':
            $title = "entrada Biometrico";
            $links = [''];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/asistencia/entrada_biometrico.php";
            $scripts = ['js/entrada-biometrico.js'];
            include "./components/footer.php";
        break;

        case 'salida-Biometrico':
            $title = "salida Biometrico";
            $links = [''];
            include "./components/header.php";
            include "./components/menu.php";
            include "$ruta/asistencia/salida_biometrico.php";
            $scripts = ['js/salida-biometrico.js'];
            include "./components/footer.php";
        break;
    }
    