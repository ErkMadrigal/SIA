<?php 

     class ConsultasEmpleados{
        private static $database;
        private static $respuesta;
        
        public function __construct(){
            self::$database = new DataBase();
            self::$respuesta = null;
        }

        public function __destruct(){
            self::$database = null;
            self::$respuesta = null;
        }   
        
        public static function getEmpleados($limit, $offset, $zonas = [], $puestos = [], $fechas = null, $status = null) {
            try {
                $dbc = self::$database::getConnection();

                $whereClauses = [];
                $params = [];

                if (!empty($zonas)) {
                    $placeholdersZonas = implode(',', array_fill(0, count($zonas), '?'));
                    $whereClauses[] = "id_zona IN ($placeholdersZonas)";
                    $params = array_merge($params, $zonas);
                }

                if (!empty($puestos)) {
                    $placeholdersPuestos = implode(',', array_fill(0, count($puestos), '?'));
                    $whereClauses[] = "id_puesto IN ($placeholdersPuestos)";
                    $params = array_merge($params, $puestos);
                }

                if (!empty($fechas)) {
                    $rangos = explode(' a ', $fechas);
                    if (count($rangos) === 2) {
                        $whereClauses[] = "fecha_ingreso BETWEEN ? AND ?";
                        $params[] = $rangos[0];
                        $params[] = $rangos[1];
                    }
                }

                if (!empty($status) && $status !== '000') {
                    
                    $whereClauses[] = "estatus = ?";
                    $params[] = $status;
                }

                $whereSQL = "";
                if (count($whereClauses) > 0) {
                    $whereSQL = " WHERE " . implode(" AND ", $whereClauses);
                }

                // Convierte a int para evitar inyección y errores
                $limit = (int)$limit;
                $offset = (int)$offset;

                $sql = "SELECT  e.id, CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) AS nombre, e.curp, e.fecha_ingreso, mp.valor puesto, mz.valor zona, ms.valor estatus 
                        FROM empleados e
                        LEFT JOIN multicatalogo mz on e.id_zona = mz.id
                        LEFT JOIN multicatalogo mp on e.id_puesto = mp.id
                        LEFT JOIN multicatalogo ms on e.estatus = ms.id
                        $whereSQL
                        ORDER BY id DESC 
                        LIMIT $limit OFFSET $offset";

                $stmt = $dbc->prepare($sql);
                $stmt->execute($params);

                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $sqlCount = "SELECT COUNT(*) as total FROM empleados $whereSQL";
                $stmtCount = $dbc->prepare($sqlCount);
                $stmtCount->execute($params);

                $totalData = $stmtCount->fetch(PDO::FETCH_ASSOC);

                self::$respuesta["status"] = "ok";
                self::$respuesta["total"] = $totalData['total'] ?? 0;
                self::$respuesta["data"] = $data;

            } catch (PDOException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }

            return self::$respuesta;
        }

        public static function getEmpleado($id_empleado){
            try{
                $id_empleado = intval($id_empleado);
                $sql = "SELECT e.*, CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) AS nombreCompleto, mp.valor puesto, mz.valor zona, ms.valor estatus, mb.valor institucionBancaria FROM empleados e LEFT JOIN multicatalogo mz on e.id_zona = mz.id LEFT JOIN multicatalogo mp on e.id_puesto = mp.id LEFT JOIN multicatalogo ms on e.estatus = ms.id LEFT JOIN multicatalogo mb on e.id_banco = mb.id WHERE e.id = :id_empleado";
                
                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);
                $stmt->bindParam(":id_empleado", $id_empleado, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);  
                
                if($data){
                    self::$respuesta["status"] = "ok";
                    self::$respuesta["data"] = $data;
                }else{
                    self::$respuesta["status"] = "error";
                    self::$respuesta["mensaje"] = "Empleado no encontrado";
                    self::$respuesta["data"] = [];
                }
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
        }

        public static function getCountData(){
            try{
                $sql = "SELECT count(*) as empleadosTotales FROM empleados";
                
                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);  
                self::$respuesta = $data;
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
        }

        public static function getTotalByEstatus($estatus){
            try {
                $sql = "SELECT COUNT(*) as empleadosTotales FROM empleados WHERE estatus = :estatus";

                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);
                $stmt->bindParam(':estatus', $estatus, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                return $data;
            } catch (PDOException $e) {
                return [
                    "status" => "error",
                    "data" => [],
                    "mensaje" => $e->getMessage()
                ];
            }
        }

        public static function searchEmpleado($search, $limit, $offset) {
            try {
                $sqlBase = " FROM empleados e
                            LEFT JOIN multicatalogo mz on e.id_zona = mz.id
                            LEFT JOIN multicatalogo mp on e.id_puesto = mp.id
                            LEFT JOIN multicatalogo ms on e.estatus = ms.id
                            WHERE CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) LIKE :termino 
                            OR curp LIKE :termino 
                            OR rfc LIKE :termino 
                            OR nss LIKE :termino ";

                // Consulta de datos
                $sqlSelect = "SELECT e.id, CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) AS nombre, e.curp, e.fecha_ingreso, mp.valor puesto, mz.valor zona, ms.valor estatus" . $sqlBase. " ORDER BY id DESC LIMIT :limit OFFSET :offset";
                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sqlSelect);
                $like = '%' . $search . '%';
                $stmt->bindParam(':termino', $like, PDO::PARAM_STR);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Consulta del total
                $sqlCount = "SELECT COUNT(*) AS total " . $sqlBase;
                $stmt = $dbc->prepare($sqlCount);
                $stmt->bindParam(':termino', $like, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->fetch(PDO::FETCH_ASSOC);

                self::$respuesta['status'] = 'ok';
                self::$respuesta['data'] = $data;
                self::$respuesta['total'] = $total['total'];

            } catch (PDOException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
        }

        public static function getExistEmpleadoBiometrico($query){
            try {
                $sql = "SELECT 
                        e.id, CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) AS nombreCompleto, 
                        e.no_empleado, e.curp, e.rfc, e.fotos
                        FROM empleados e
                        WHERE (curp LIKE :query OR rfc LIKE :query)";

                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);

                // Agregamos el comodín para la búsqueda
                $busqueda = '%' . $query . '%';
                $stmt->bindParam(":query", $busqueda, PDO::PARAM_STR);

                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                self::$respuesta["status"] = "ok";
                self::$respuesta["data"] = $data;

            } catch(PDOException $e) {

                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }


            return self::$respuesta;

        }

        public static function getDataEmpleadoBiometrico($query){
            try {
                $sql = "SELECT 
                        e.id, CONCAT(e.nombre, ' ', e.paterno, ' ', e.materno) AS nombreCompleto, 
                        e.no_empleado, e.curp, e.rfc, e.fotos, a.id, a.latitud, a.longitud, a.fecha, a.hora, a.id_status
                        FROM empleados e
                        LEFT JOIN asistencias a ON e.id = a.id_empleado
                        WHERE (curp LIKE :query OR rfc LIKE :query) AND DATE(a.fecha) = CURDATE() AND a.id_status in (1,2) order by a.id desc limit 1";

                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);

                // Agregamos el comodín para la búsqueda
                $busqueda = '%' . $query . '%';
                $stmt->bindParam(":query", $busqueda, PDO::PARAM_STR);

                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                self::$respuesta["status"] = "ok";
                self::$respuesta["data"] = $data;

            } catch(PDOException $e) {

                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }


            return self::$respuesta;

        }

        public static function getEmpleadoBiometrico($query){
            try {
                $sql = "SELECT 
                            id, 
                            CONCAT(nombre, ' ', paterno, ' ', materno) AS nombreCompleto, 
                            no_empleado,
                            curp, 
                            rfc,
                            fotos
                        FROM empleados 
                        WHERE (curp LIKE :query OR rfc LIKE :query)";

                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);

                // Agregamos el comodín para la búsqueda
                $busqueda = '%' . $query . '%';
                $stmt->bindParam(":query", $busqueda, PDO::PARAM_STR);

                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                self::$respuesta["status"] = "ok";
                self::$respuesta["data"] = $data;

            } catch(PDOException $e) {

                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }


            return self::$respuesta;

        }
        
    }
    