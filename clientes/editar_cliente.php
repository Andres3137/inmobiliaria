<?php
include '../conexion.php';

if (!isset($_GET['cod_cli'])) {
    echo "Código de cliente no especificado.";
    exit;
}

$cod_cli = $_GET['cod_cli'];
$sql = "SELECT * FROM clientes WHERE cod_cli = $cod_cli";
$result = $conn->query($sql);
$cliente = $result->fetch_assoc();

// Obtener tipos de inmueble
$sqlinmueble = "SELECT * FROM tipo_inmueble";
$resultinmueble = $conn->query($sqlinmueble);

// Obtener empleados
$sqlempleado = "SELECT * FROM empleados";
$resultempleado = $conn->query($sqlempleado);

// Obtener valores ENUM del tipo de documento
$enumQuery = $conn->query("SHOW COLUMNS FROM clientes LIKE 'tipo_doc_cli'");
$rowEnum = $enumQuery->fetch_assoc();
preg_match("/^enum\((.*)\)$/", $rowEnum['Type'], $matches);
$enumValues = explode(",", $matches[1]);
?>

<h2>Editar Cliente</h2>
<form action="actualizar_cliente.php" method="POST">
    <input type="hidden" name="cod_cli" value="<?= $cliente['cod_cli'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nom_cli" value="<?= $cliente['nom_cli'] ?>" required><br>

    <label>Tipo de Documento:</label>
    <select name="tipo_doc_cli">
        <?php foreach ($enumValues as $value): 
            $cleanValue = trim($value, "'");
        ?>
            <option value="<?= $cleanValue ?>" <?= $cleanValue == $cliente['tipo_doc_cli'] ? 'selected' : '' ?>><?= $cleanValue ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Número de Documento:</label>
    <input type="text" name="doc_cli" value="<?= $cliente['doc_cli'] ?>"><br>

    <label>Dirección:</label>
    <input type="text" name="dic_cli" value="<?= $cliente['dic_cli'] ?>"><br>

    <label>Teléfono:</label>
    <input type="text" name="tel_cli" value="<?= $cliente['tel_cli'] ?>"><br>

    <label>Email:</label>
    <input type="email" name="email_cli" value="<?= $cliente['email_cli'] ?>"><br>

    <label>Tipo Inmueble:</label>
    <select name="cod_tipoinm">
        <?php while($inmueble = $resultinmueble->fetch_assoc()): ?>
            <option value="<?= $inmueble['cod_tipoinm'] ?>" <?= $inmueble['cod_tipoinm'] == $cliente['cod_tipoinm'] ? 'selected' : '' ?>>
                <?= $inmueble['nom_tipoinm'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>Valor Máximo:</label>
    <input type="number" name="valor_maximo" value="<?= $cliente['valor_maximo'] ?>"><br>

    <label>Fecha de creación:</label>
    <input type="date" name="fecha_creacion" value="<?= substr($cliente['fecha_creacion'], 0, 10) ?>"><br>

    <label>Empleado:</label>
    <select name="cod_emp">
        <?php while($empleado = $resultempleado->fetch_assoc()): ?>
            <option value="<?= $empleado['cod_emp'] ?>" <?= $empleado['cod_emp'] == $cliente['cod_emp'] ? 'selected' : '' ?>>
                <?= $empleado['nom_emp'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>Notas:</label><br>
    <textarea name="notas_cli"><?= $cliente['notas_cli'] ?></textarea><br>

    <input type="submit" value="Actualizar Cliente">
</form>
