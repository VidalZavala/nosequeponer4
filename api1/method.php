<?php
require "config/Conexion.php";
$datos = json_decode(file_get_contents('php://input'), true);
//print_r($_SERVER['REQUEST_METHOD']);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Consulta SQL para seleccionar datos de la tabla de maestros
        $sql = "SELECT id, nombre, apodo, tel, creado_en FROM clase_fued";

        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            // Devolver los resultados en formato JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de clase_fued.";
        }

        $conexion->close();
        break;

    case 'POST':
            // Recibir los datos del formulario HTML
            $nombre = $datos['nombre'];
            $apodo = $datos['apodo'];
            $tel = $datos['tel'];

            // Insertar los datos en la tabla de clase_fued
            $sql = $conexion->prepare("INSERT INTO clase_fued (nombre, apodo, tel) VALUES (?,?,?)");
            $sql->bind_param("sss", $nombre, $apodo, $tel);
            if($sql->execute()){
                echo "Datos insertados con exito";
            } else {
                echo "Error al insertar datos" . $sql->error;
            }
        $sql->close();
        break;

        case 'PATCH':
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        $apodo = $datos['apodo'];
        $tel = $datos['tel'];
        #$foto = $datos['foto'];

    
        $actualizaciones = array();
        if (!empty($apodo)) {
            $actualizaciones[] = "apodo = '$apodo'";
        }
        if (!empty($tel)) {
            $actualizaciones[] = "tel = '$tel'";
        }
    
        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE clase_fued SET $actualizaciones_str WHERE id = $id";
    
        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;
    

        case 'PUT':
            $nombre = $datos['nombre'];
            $id = $datos['id'];
            $apodo = $datos['apodo'];
            $tel = $datos['tel'];
            $sql = "UPDATE clase_fued SET apodo = '$apodo', tel = '$tel' WHERE id = $id";
    
            if ($conexion->query($sql) === TRUE) {
                echo "Registro actualizado con éxito.";
            } else {
                echo "Error al actualizar registro: " . $conexion->error;
            }
            break;
    

            case 'DELETE':
                $id = $datos['id'];
                
                $stmt = $conexion->prepare("DELETE FROM clase_fued WHERE id = ?");
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    echo "Registro eliminado con éxito.";
                } else {
                    echo "Error al eliminar registro: " . $stmt->error;
                }
                $stmt->close();
                break;
                    
            default:
                echo "Método de solicitud no válido.";
                break;
        }

?>