<?php 

    include_once("conexion.php"); // Asegúrate de incluir tu archivo de conexión
    
        try {
           
    
            // Inserta en la tabla asociado_negocio
            $stmt = $conn->prepare('INSERT INTO asociado_negocio (nit_asociado_n, nombre_empresa) VALUES (?, ?)');
            $stmt->bindParam(1, $_POST['nit_asociado_n']);
            $stmt->bindParam(2, $_POST['nombre_empresa']);
            $stmt->execute();
    
            // Obtén el ID del último registro insertado en asociado_negocio
            $asociadoNegocioId = $conn->lastInsertId();
    
            // Inserta en la tabla empresa_accionista
            foreach ($_POST['empresa_accionista'] as $empresa) {
                $stmt = $conn->prepare('INSERT INTO empresa_accionista (nit_e_accionista, nombre_empresa_accionista, num_accionistas, nit_asociado_n) VALUES (?, ?, ?, ?)');
                $stmt->bindParam(1, $empresa['nit_e_accionista']);
                $stmt->bindParam(2, $empresa['nombre_empresa_accionista']);
                $stmt->bindParam(3, $empresa['num_accionistas']);
                $stmt->bindParam(4, $asociadoNegocioId);
                $stmt->execute();
    
                // Obtén el ID del último registro insertado en empresa_accionista
                $empresaAccionistaId = $conn->lastInsertId();
    
                // Inserta en la tabla accionista
                foreach ($empresa['accionistas'] as $accionista) {
                    $stmt = $conn->prepare('INSERT INTO accionista (id_accionista, nombre_accionista, asociado_negocio_id) VALUES (?, ?, ?)');
                    $stmt->bindParam(1, $accionista['id_accionista']);
                    $stmt->bindParam(2, $accionista['nombre_accionista']);
                    $stmt->bindParam(3, $empresaAccionistaId);
                    $stmt->execute();
                }
            }
    
            // Confirma la transacción si todo fue exitoso
            $conn->commit();
            echo "Datos insertados correctamente";
        } catch (PDOException $e) {
            // Deshace la transacción en caso de error
            $conn->rollBack();
            echo "Error al insertar datos: " . $e->getMessage();
        }
  
    ?>