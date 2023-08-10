<!DOCTYPE html>
<html>
 // CREATE DATABASE temperaturas;

USE temperaturas;

CREATE TABLE registros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hora TIME,
    fecha DATE,
    temperatura DECIMAL(5,2)
); datos para crear la base de datos
    //
<head>
    <title>Registro de información de la tabla hora, tiempo, temperatura</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #81d8d0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #81d8d0;
            color: #444;
        }

        th,
        td:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        th,
        td:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        form {
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="time"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button {
            background-color: #81d8d0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c43b1f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tabla de Hora, Fecha y Temperatura</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "temperaturas";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if (isset($_POST['guardar'])) {
            $hora = $_POST['hora'];
            $fecha = $_POST['fecha'];
            $temperatura = $_POST['temperatura'];

            $sql = "INSERT INTO registros (hora, fecha, temperatura) VALUES ('$hora', '$fecha', '$temperatura')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro guardado exitosamente.";
            } else {
                echo "Error al guardar el registro: " . $conn->error;
            }
        }

        $sql = "SELECT * FROM registros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Temperatura</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["hora"] . "</td>
                        <td>" . $row["fecha"] . "</td>
                        <td>" . $row["temperatura"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay registros.";
        }

        $conn->close();
        ?>
        <form method="post">
            <label>Hora:</label>
            <input type="time" name="hora" required>
            <label>Fecha:</label>
            <input type="date" name="fecha" required>
            <label>Temperatura:</label>
            <input type="number" step="0.01" name="temperatura" required>
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>
</body>

</html>
