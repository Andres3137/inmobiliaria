<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="../estilos.css">
   
<style>
    #map{
        height: 400px;
        width: 100%;
    }
    .map{
        height: 400px;
        width: 100%;
    }
    form{
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    label{
        display: block;
        margin-bottom: 10px;
    }
    input,select,button{
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>
</head>
<body>
    
    <form action="guardar_oficina.php" method="post" enctype="multipart/form-data">
    <h2>Registro de oficina</h2>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" required>

        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" id="telefono" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>

        <label>Latitud</label>
        <input type="text" name="latitud" id="latitud" readonly>

        <label>Longitud</label>
        <input type="text" name="longitud" id="longitud" readonly>

        <!-- <div id="map" class="map" name="map"></div> -->
        <section id="map"></section>

        <label for="foto">Foto del Almacen</label>
        <input type="file" name="foto" id="foto" accept="image/*">

        <button type="submit">Guardar oficina</button>
        <input type="button" value="Consultar" onclick="location.href='consultar_oficina.php'">
    </form>


<script>
    const map = L.map('map').setView([4.6097, -74.0817], 13);


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

    const marker = L.marker([4.6097, -74.0817],{ draggable: true}).addTo(map);

    function updateLatLng(){
        const position = marker.getLatLng();

        document.getElementById('latitud').value = position.lat.toFixed(6);
        document.getElementById('longitud').value = position.lng.toFixed(6);
    }
    updateLatLng();

    marker.on('dragend', updateLatLng);


    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition((position) => {
            const {latitude, longitude} = position.coords;
            marker.setLatLng([latitude, longitude]);
            map.setView([latitude, longitude], 13);
            updateLatLng();
        });
    }
</script>
</body>
</html>