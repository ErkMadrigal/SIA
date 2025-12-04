<?php
    class ControllerEmpleados{
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

       
        public static function registro( $no_empleado,$id_unidad_negocio,$id_regional,$id_zona,$id_empresa,$id_servicio,$curp,$rfc,$nss, $cp, $fecha_ingreso,$paterno,$materno,$nombre,$id_turno,$id_puesto,$sueldo,$id_periocidad,$cuenta,$clave_interbancaria,$id_banco,$estatus, $alergias, $foto){
            try{
                
                $sql = "INSERT INTO empleados (no_empleado, id_unidad_negocio, id_regional, id_zona, id_empresa, id_servicio, curp, rfc, nss, CP_fiscal, fecha_ingreso, paterno, materno, nombre, id_turno, id_puesto, sueldo, id_periocidad, cuenta, clave_interbancaria, id_banco, estatus, alergias, fotos) values(:no_empleado, :id_unidad_negocio, :id_regional, :id_zona, :id_empresa, :id_servicio, :curp, :rfc, :nss, :CP_fiscal, :fecha_ingreso, :paterno, :materno, :nombre, :id_turno, :id_puesto, :sueldo, :id_periocidad, :cuenta, :clave_interbancaria, :id_banco, :estatus, :alergias, :fotos)";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":paterno", $paterno); 
                $stmt->bindParam(":materno", $materno); 
                $stmt->bindParam(":nombre", $nombre); 
                $stmt->bindParam(":nss", $nss);
                $stmt->bindParam(":curp", $curp); 
                $stmt->bindParam(":rfc", $rfc); 
                $stmt->bindParam(":CP_fiscal", $cp); 
                $stmt->bindParam(":fecha_ingreso", $fecha_ingreso); 
                $stmt->bindParam(":clave_interbancaria", $clave_interbancaria); 
                $stmt->bindParam(":id_banco", $id_banco); 
                $stmt->bindParam(":sueldo", $sueldo); 
                $stmt->bindParam(":alergias", $alergias); 
                $stmt->bindParam(":fotos", $foto); 
                
                
                $stmt->bindParam(":id_servicio", $id_servicio); 
                $stmt->bindParam(":id_unidad_negocio", $id_unidad_negocio);
                $stmt->bindParam(":id_zona", $id_zona);
                $stmt->bindParam(":id_regional", $id_regional);
                $stmt->bindParam(":no_empleado", $no_empleado);
                $stmt->bindParam(":id_empresa", $id_empresa,); 
                $stmt->bindParam(":id_turno", $id_turno); 
                $stmt->bindParam(":id_puesto", $id_puesto); 
                $stmt->bindParam(":id_periocidad", $id_periocidad); 
                $stmt->bindParam(":cuenta", $cuenta); 
                $stmt->bindParam(":estatus", $estatus);
                $stmt->execute();
                $lastInsertID = $db->lastInsertId();

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Registro Exitoso";
                self::$respuesta["last_insert_id"] = $lastInsertID;
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function actualizarPersonal( $id, $curp, $rfc, $nss, $cp, $paterno, $materno, $nombre){
            try{
                
                $sql = "UPDATE empleados SET curp = :curp, rfc = :rfc, nss = :nss, CP_fiscal = :CP_fiscal, paterno = :paterno, materno = :materno, nombre = :nombre WHERE id = :id";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":curp", $curp); 
                $stmt->bindParam(":rfc", $rfc); 
                $stmt->bindParam(":nss", $nss); 
                $stmt->bindParam(":CP_fiscal", $cp); 
                $stmt->bindParam(":paterno", $paterno); 
                $stmt->bindParam(":materno", $materno); 
                $stmt->bindParam(":nombre", $nombre); 
                $stmt->bindParam(":id", $id);

                $stmt->execute();
                $lastInsertID = $id;

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Registro Actualizado";
                self::$respuesta["last_insert_id"] = $lastInsertID;
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function actualizarTrabajo( $id, $id_unidad_negocio, $id_regional, $id_zona, $id_empresa, $id_servicio,$id_turno, $id_puesto, $sueldo, $id_periocidad){
            try{
                
                $sql = "UPDATE empleados SET id_unidad_negocio = :id_unidad_negocio, id_regional = :id_regional, id_zona = :id_zona, id_empresa = :id_empresa, id_servicio = :id_servicio, id_turno = :id_turno, id_puesto = :id_puesto, sueldo = :sueldo, id_periocidad = :id_periocidad WHERE id = :id";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id_unidad_negocio", $id_unidad_negocio);
                $stmt->bindParam(":id_regional", $id_regional);
                $stmt->bindParam(":id_zona", $id_zona);
                $stmt->bindParam(":id_empresa", $id_empresa,); 
                $stmt->bindParam(":id_servicio", $id_servicio); 
                $stmt->bindParam(":id_turno", $id_turno); 
                $stmt->bindParam(":id_puesto", $id_puesto); 
                $stmt->bindParam(":sueldo", $sueldo); 
                $stmt->bindParam(":id_periocidad", $id_periocidad); 
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $lastInsertID = $id;

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Registro Actualizado";
                self::$respuesta["last_insert_id"] = $lastInsertID;
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function actualizarBancario( $id, $cuenta, $clave_interbancaria, $id_banco){
            try{
                
                $sql = "UPDATE empleados SET cuenta = :cuenta, clave_interbancaria = :clave_interbancaria, id_banco = :id_banco WHERE id = :id";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":cuenta", $cuenta); 
                $stmt->bindParam(":clave_interbancaria", $clave_interbancaria); 
                $stmt->bindParam(":id_banco", $id_banco); 
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $lastInsertID = $id;

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Registro Actualizado";
                self::$respuesta["last_insert_id"] = $lastInsertID;
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function activar( $id, $estatus, $id_motivo, $finiquito, $nota, $fecha_efectiva){
            try{
                
                $sql = "UPDATE empleados SET estatus = :estatus WHERE id = :id";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":estatus", $estatus);
                $stmt->bindParam(":id", $id);
                $stmt->execute();

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "El empleado ha sido dado de baja correctamente";
                self::baja_confirmada($id, $id_motivo, $finiquito, $nota, $fecha_efectiva);
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function baja_confirmada( $id_empleado, $id_motivo, $finiquito, $nota, $fecha_efectiva){
            try{
                
                $sql = "INSERT INTO baja_empleado (id_empleado, id_motivo, finiquito, nota, fecha_efectiva) VALUES (:id_empleado, :id_motivo, :finiquito, :nota, :fecha_efectiva)";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id_empleado", $id_empleado);
                $stmt->bindParam(":id_motivo", $id_motivo);
                $stmt->bindParam(":finiquito", $finiquito);
                $stmt->bindParam(":nota", $nota);
                $stmt->bindParam(":fecha_efectiva", $fecha_efectiva);
                $stmt->execute();

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "El empleado ha sido dado de baja correctamente";
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        
        public static function newQR($id_empleado, $token){
            try{
                $creado_en = date("Y-m-d H:i:s");
                
                $sql = "INSERT INTO tokens_qr (token, id_empleado, creado_en) VALUES (:token, :id_empleado, :creado_en)";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":token", $token);
                $stmt->bindParam(":id_empleado", $id_empleado);
                $stmt->bindParam(":creado_en", $creado_en);
                $stmt->execute();

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "El token se ha sido regitrado correctamente";
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
            
        }

        public static function setToken($id_empleado){
            try{
                $sql = "SELECT * FROM tokens_qr 
                        WHERE token = :token 
                        AND usado = 0 
                        AND NOW() <= DATE_ADD(creado_en, INTERVAL 5 MINUTE)";
                
                $dbc = self::$database::getConnection();
                $stmt = $dbc->prepare($sql);
                $stmt->bindParam(":token", $token);
                $stmt->execute();
                $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);  

                if (!$tokenData) {
                    http_response_code(403);
                    self::$respuesta["status"] = "error";
                    self::$respuesta["mensaje"] = "Token inválido o expirado";
                    self::$respuesta["data"] = [];
                    return self::$respuesta; // ⚠️ salir si no hay token
                }

                // Registrar asistencia
                $stmt = $dbc->prepare("INSERT INTO asistencias (id_empleado, fecha, hora, id_token) VALUES (?, CURDATE(), CURTIME(), ?)");
                $stmt->execute([$tokenData['id_empleado'], $tokenData['id']]);

                // Marcar token como usado
                $stmt = $dbc->prepare("UPDATE tokens_qr SET usado = 1 WHERE id = ?");
                $stmt->execute([$tokenData['id']]);

                // Respuesta exitosa
                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Asistencia registrada";
                self::$respuesta["data"] = $tokenData;

            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }

            return self::$respuesta;
        }

        public static function setAsistenciaEntradaSalida($id_empleado, $latitud, $longitud, $ip, $id_status){
            try{

                
                $sql = "INSERT INTO asistencias (id_empleado, fecha, hora, latitud, longitud, ip, id_status) VALUES (:id_empleado, CURDATE(), CURTIME(), :latitud, :longitud, :ip, :id_status)";

                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id_empleado", $id_empleado);
                $stmt->bindParam(":latitud", $latitud);
                $stmt->bindParam(":longitud", $longitud);
                $stmt->bindParam(":ip", $ip);
                $stmt->bindParam(":id_status", $id_status);
                $stmt->execute();

                // Respuesta exitosa
                self::$respuesta["status"] = "ok";
                if( $id_status == 1 ){
                    self::$respuesta["mensaje"] = "Asistencia registrada";
                }
                if( $id_status == 2 ){
                    self::$respuesta["mensaje"] = "Salida registrada";
                }

            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["data"] = [];
                self::$respuesta["mensaje"] = $e->getMessage();
            }

            return self::$respuesta;
        }

        public static function updatePhoto($photo, $id){
            try{
                
                $sql = "UPDATE empleados SET fotos = :fotos WHERE id = :id";
                $db = self::$database::getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":fotos", $photo); 
                $stmt->bindParam(":id", $id);

                $stmt->execute();
                $lastInsertID = $id;

                self::$respuesta["status"] = "ok";
                self::$respuesta["mensaje"] = "Foto Actualizada";
                
            } catch (RuntimeException $e) {
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }catch(PDOException $e){
                self::$respuesta["status"] = "error";
                self::$respuesta["mensaje"] = $e->getMessage();
            }
            return self::$respuesta;
        }

    }