<?php
    $pagina_actual = '';
    $titulo = 'Proveedores';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> proveedor';
    $texto_tabla = 'Lista de proveedores';
    $ruta_card = 'anadir_proveedor.php';
    include '../../includes/templates/pagina_card.php';
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Email</th>
                    <th>Télefono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Ubicación</td>
                    <td>Email</td>
                    <td>Télefono</td>
                    <td><button class="edit">EDITAR</button></td>
                    <td><button class="delete">ELIMINAR</button></td>
                </tr>
                <!-- Repite las filas según sea necesario -->
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>