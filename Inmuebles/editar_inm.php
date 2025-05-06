<?php
include '../conexion.php';

if (!isset($_GET['cod_inm'])) {
    echo "Código no especificado.";
    exit;
}

$cod_inm = intval($_GET['cod_inm']);
$sql = "SELECT * FROM inmuebles WHERE cod_inm = $cod_inm";
$result = $conn->query($sql);
$inmueble = $result->fetch_assoc();

if (!$inmueble) {
    echo "Inmueble no encontrado.";
    exit;
}

// Obtener listas necesarias
$resultinmueble = $conn->query("SELECT * FROM tipo_inmueble");
$resultempleado = $conn->query("SELECT * FROM empleados");
$resultpropietario = $conn->query("SELECT * FROM propietarios");
$resultoficina = $conn->query("SELECT * FROM oficinas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Inmueble</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; width: 100%; }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 10px;}
        input, select, textarea, button { width: 100%; padding: 10px; margin-top: 5px; }
    </style>
</head>
<body>

<form action="actualizar_inm.php" method="POST" enctype="multipart/form-data">
    <h2>Editar Inmueble</h2>
    <input type="hidden" name="cod_inm" value="<?= $inmueble['cod_inm'] ?>">

    <label>Dirección:</label>
    <input type="text" name="di_inm" value="<?= $inmueble['di_inm'] ?>" required />

    <label>Barrio:</label>
    <input type="text" name="barrio_inm" value="<?= $inmueble['barrio_inm'] ?>" required />

    <label>Ciudad:</label>
    <input type="text" name="ciudad_inm" value="<?= $inmueble['ciudad_inm'] ?>" required />

    <label>Departamento:</label>
    <input type="text" name="departamento_inm" value="<?= $inmueble['departamento_inm'] ?>" required />

    <label>Ubicación (Latitud y Longitud):</label>
    <input type="text" id="latitud" name="latitud" value="<?= $inmueble['latitud'] ?>" readonly />
    <input type="text" id="longitud" name="longitud" value="<?= $inmueble['longitud'] ?>" readonly />

    <div id="map"></div>

    <label>Foto actual:</label>
    <?php if (!empty($inmueble['foto'])): ?>
        <img src="<?= $inmueble['foto'] ?>" alt="Foto" width="150">
    <?php endif; ?>
    <label for="foto">Cambiar foto:</label>
    <input type="file" id="foto" name="foto" />

    <label>Web 1:</label>
    <input type="text" name="web_p1" value="<?= $inmueble['web_p1'] ?>" />

    <label>Web 2:</label>
    <input type="text" name="web_p2" value="<?= $inmueble['web_p2'] ?>" />

    <label>Tipo de inmueble:</label>
    <select name="cod_tipoinm" required>
        <?php while($tipo = $resultinmueble->fetch_assoc()): ?>
            <option value="<?= $tipo['cod_tipoinm'] ?>" <?= $tipo['cod_tipoinm'] == $inmueble['cod_tipoinm'] ? 'selected' : '' ?>>
                <?= $tipo['nom_tipoinm'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Número de habitaciones:</label>
    <input type="number" name="num_hab" value="<?= $inmueble['num_hab'] ?>" required />

    <label>Precio de alquiler:</label>
    <input type="number" name="precio_alq" value="<?= $inmueble['precio_alq'] ?>" required />

    <label>Propietario:</label>
    <select name="cod_propietarios" required>
        <?php while($prop = $resultpropietario->fetch_assoc()): ?>
            <option value="<?= $prop['cod_propietarios'] ?>" <?= $prop['cod_propietarios'] == $inmueble['cod_propietarios'] ? 'selected' : '' ?>>
                <?= $prop['nomb_propietario'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Características:</label>
    <select name="caracteristica_inm" required>
        <option value="conjunto" <?= $inmueble['caracteristicas_inm'] == 'conjunto' ? 'selected' : '' ?>>Conjunto</option>
        <option value="urbanizacion" <?= $inmueble['caracteristicas_inm'] == 'urbanizacion' ? 'selected' : '' ?>>Urbanización</option>
    </select>

    <label>Notas:</label>
    <textarea name="notas_inm"><?= $inmueble['notas_inm'] ?></textarea>

    <label>Empleado:</label>
    <select name="cod_emp" required>
        <?php while($emp = $resultempleado->fetch_assoc()): ?>
            <option value="<?= $emp['cod_emp'] ?>" <?= $emp['cod_emp'] == $inmueble['cod_emp'] ? 'selected' : '' ?>>
                <?= $emp['nom_emp'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Oficina:</label>
    <select name="cod_ofi" required>
        <?php while($ofi = $resultoficina->fetch_assoc()): ?>
            <option value="<?= $ofi['cod_ofi'] ?>" <?= $ofi['cod_ofi'] == $inmueble['cod_ofi'] ? 'selected' : '' ?>>
                <?= $ofi['nom_ofi'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Actualizar Inmueble</button>
    <input type="button" value="Cancelar" onclick="window.location.href='consultar_inmueble.php'">
</form>

<script>
    const latInput = document.getElementById('latitud');
    const lngInput = document.getElementById('longitud');
    const map = L.map('map').setView([latInput.value || 4.6097, lngInput.value || -74.0817], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([latInput.value || 4.6097, lngInput.value || -74.0817], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function () {
        const pos = marker.getLatLng();
        latInput.value = pos.lat.toFixed(6);
        lngInput.value = pos.lng.toFixed(6);
    });
</script>

</body>
</html>
