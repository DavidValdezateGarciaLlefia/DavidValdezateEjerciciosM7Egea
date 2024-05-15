<?php
class IntelForm {
    private $pdo;

    public function __construct() {
        $dsn = 'pgsql:host=localhost;dbname=ajax;user=postgres;password=root';
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }

    public function createTable($tableName, $columnDefinitions) {
        $tableName = '"' . str_replace('"', '""', $tableName) . '"';
        $columns = explode(', ', $columnDefinitions);
        $formattedColumns = implode(', ', array_map(function($col) {
            $parts = explode(' ', $col);
            $columnName = '"' . str_replace('"', '""', $parts[0]) . '"';
            $columnType = strtoupper($parts[1]); 
            return "$columnName $columnType";
        }, $columns));
    
        $sql = "CREATE TABLE IF NOT EXISTS $tableName ($formattedColumns)";
        try {
            $this->pdo->exec($sql);
            return "Tabla '$tableName' creada exitosamente.";
        } catch (PDOException $e) {
            return "Error al crear la tabla: " . $e->getMessage();
        }
    }

    public function readAll($tableName) {
        $sql = "SELECT * FROM \"$tableName\"";
        try {
            $stmt = $this->pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($results);
        } catch (PDOException $e) {
            return json_encode(["error" => "Error al leer los datos: " . $e->getMessage()]);
        }
    }

    public function read($tableName, $id) {
        $sql = "SELECT * FROM \"$tableName\" WHERE id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return json_encode($result);
        } catch (PDOException $e) {
            return json_encode(["error" => "Error al leer los datos: " . $e->getMessage()]);
        }
    }

    public function update($tableName, $id, $updateData) {
        $updateData = json_decode($updateData, true);
        $columns = array_keys($updateData);
        $values = array_values($updateData);
        $setString = implode(", ", array_map(fn($col) => "\"$col\" = ?", $columns));
        
        $sql = "UPDATE \"$tableName\" SET $setString WHERE id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([...$values, $id]);
            return "Registro actualizado correctamente.";
        } catch (PDOException $e) {
            return "Error al actualizar el registro: " . $e->getMessage();
        }
    }

    public function delete($tableName, $id) {
        $sql = "DELETE FROM \"$tableName\" WHERE id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Registro eliminado correctamente.";
        } catch (PDOException $e) {
            return "Error al eliminar el registro: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $table = $_POST['tableName'];
    $intelForm = new IntelForm();

    switch ($action) {
        case 'create':
            $columnDefinitions = $_POST['columnDefinitions'];
            echo $intelForm->createTable($table, $columnDefinitions);
            break;
        case 'readAll':
            echo $intelForm->readAll($table);
            break;
        case 'read':
            $id = $_POST['id'];
            echo $intelForm->read($table, $id);
            break;
        case 'update':
            $id = $_POST['id'];
            $updateData = $_POST['updateData'];
            echo $intelForm->update($table, $id, $updateData);
            break;
        case 'delete':
            $id = $_POST['id'];
            echo $intelForm->delete($table, $id);
            break;
    }
}
?>