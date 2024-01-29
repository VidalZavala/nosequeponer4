<!DOCTYPE html>
<html>
<head>
    <title>API de Ejemplo (GET, POST, PUT, DELETE)</title>
    <script src="min.js"></script>
</head>
<body>
    <h1>Eliminar Entrada por ID</h1>
    
    <form id="deleteForm">
        <label for="id_entrada">ID de la Entrada a Eliminar:</label>
        <input type="text" id="id_entrada" name="id_entrada" required>
        <button type="button" id="deleteButton">Eliminar</button>
    </form>

    <div id="response"></div>

    <script>
        // Agregar un evento al botón para enviar la solicitud DELETE
        document.getElementById('deleteButton').addEventListener('click', function () {
            var id_entrada = document.getElementById('id_entrada').value;

            fetch('method.php?id_entrada=' + id_entrada, {
                method: 'DELETE'
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(data) {
                document.getElementById('response').textContent = data;
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
