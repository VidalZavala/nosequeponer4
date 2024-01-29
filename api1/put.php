<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Entrada de Diario</title>
</head>
<body>
    <h1>Actualizar Entrada de Diario</h1>
    
    <form id="updateForm">
        <label for="id_usuario">ID de Usuario:</label>
        <input type="text" id="id_usuario" name="id_usuario" required><br>

        <label for="id_entrada">ID de la Entrada a Actualizar:</label>
        <input type="text" id="id_entrada" name="id_entrada" required><br>

        <label for="titulo">Nuevo Título:</label>
        <input type="text" id="titulo" name="titulo"><br>

        <label for="contenido">Nuevo Contenido:</label>
        <input type="text" id="contenido" name="contenido"><br>

        <button type="button" id="putButton">Actualizar con PUT</button>
        <button type="button" id="patchButton">Actualizar con PATCH</button>
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('putButton').addEventListener('click', function () {
            actualizarEntrada('PUT');
        });

        document.getElementById('patchButton').addEventListener('click', function () {
            actualizarEntrada('PATCH');
        });

        function actualizarEntrada(metodo) {
            var id_usuario = document.getElementById('id_usuario').value;
            var id_entrada = document.getElementById('id_entrada').value;
            var titulo = document.getElementById('titulo').value;
            var contenido = document.getElementById('contenido').value;

            var data = new URLSearchParams();
            data.append('id_usuario', id_usuario);
            data.append('id_entrada', id_entrada);
            data.append('titulo', titulo);
            data.append('contenido', contenido);

            fetch('method.php', {
                method: metodo,
                body: data
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
        }
    </script>
</body>
</html>
