<?php	
    $pagina_actual = '';
    require 'config/registrar_cliente.php';
    include './includes/templates/header.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $numeroDocumento = $_POST['numeroDocumento'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $direccion = $_POST['direccion'];
        registrarCliente($nombre, $apellidos, $tipoDocumento, $numeroDocumento, $telefono, $correo, $password, $direccion);
    }

    $urlAnterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $urlEsperada = "iniciar_sesion_cliente.php"; 

    $parsedUrl = parse_url($urlAnterior, PHP_URL_PATH);
    $filename = basename($parsedUrl);
    $mostrarBotonAtras = false;

    if ($filename === $urlEsperada){
        $mostrarBotonAtras = true;
    }

    if(isset($_SESSION['registro'])){
        alertaRegistro('Usuario registrado exitosamente');
        unset($_SESSION['registro']);
    }
?>

<?php if ($mostrarBotonAtras): ?>
    <div class="contenedor contenedor-boton-atras">
        <a href="./iniciar_sesion_cliente.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
        </svg>Ir atrás</a>
    </div>
<?php endif; ?>

<h1 class="titulo-h1-pagina">Formulario de registro de cliente</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-registro"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" id="nombre" name="nombre" required class="inputs">
                </div>
                <div>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" required class="inputs">
                </div>
                <div>
                    <label for="tipoDocumento">Tipo de documento</label>
                    <select name="tipoDocumento" id="tipoDocumento" required class="inputs">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                        <option value="Cédula de extranjería">Cédula de extranjería</option>
                        <option value="Pasaporte">Pasaporte</option>
                    </select>
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="numeroDocumento">Número de documento</label>
                    <input type="number" id="numeroDocumento" name="numeroDocumento" required class="inputs">
                </div>
                <div>
                    <label for="telefono">Teléfono</label>
                    <input type="number" id="telefono" name="telefono" required class="inputs">
                </div>
                <div>
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div class="input-password">
                    <label for="password">Contraseña</label>
                    <input type="password" id="clave" name="password" required class="inputs">
                    <div class="toggle-password" id="toggle-password" onclick="cambiarIconoClave()">
                        <span id="show-eye" class="show-eye">
                            <svg width="23" height="23" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect x="0.5" y="0.5" width="26" height="26" fill="url(#pattern0_198_362)"/>
                                <defs>
                                <pattern id="pattern0_198_362" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_198_362" transform="scale(0.0111111)"/>
                                </pattern>
                                <image id="image0_198_362" width="90" height="90" xlink:href="data:image/png;base64,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"/>
                                </defs>
                            </svg>
                        </span>
                        <span id="hide-eye" class="hide-eye">
                            <svg width="23" height="23" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="26" height="26" fill="url(#pattern0_405_9)"/>
                                <defs>
                                <pattern id="pattern0_405_9" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_405_9" transform="scale(0.0111111)"/>
                                </pattern>
                                <image id="image0_405_9" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAHKUlEQVR4nO2da4hVVRTH94yVPelpYs5d6969z6iNYaQ9hKJRIhjC0oKz1vVRfgitsMKgoCKcXvSgl32osALpU9SHiMTpIWEWBkI+epAloSaVpTlaaWNkGuvcS4w2c+eee9Y+c+/M+cP5MhfOOud31117r7XX3mNMH2o37cf19fdMinLID1rg9xDnn6h530zHQHbIR+TKYKcAOYOdIuQMtrJk4HNAXf2Bji6griDoGKlte9iprS08wSK/Uwl2FrOVlMFOURnsFJXBTlEZ7BSVwU5RGewUlcFOURnsFCWZYRoZpLXh6Q5puoXinQ5pmQNe6ZC/tMC7HFK3Qz5cssX75G8W6SuHvMoCv+AgXGBzxYsbvvLoB3Y4wiFPs8BPO+TPHPKhivev4rLIfzugzx3Q4wHSVGM6m81whR0gTRWPtUi7k4Id8ALeaZFftrnwCjMcYLdLAStHN0ko8A63/5rNxgD45paW8CQz1GAHQcdIi+GtFnnrYAHuI7z8aoE620aFp5qhANsCf2qRfxhssBWc4RcHfLvMrEzDezbW/2WRvgtydK1p9Hm2a5DLIr9p7bxzTb1qqHi2K8fvAtBcMzxg0z8WaIMFesYhzSq00CXWhjBmzIyT5RcEMOfMAMI2+cwCL7FAqy3wQWXgr00aPe8UMyRhA223wPdMOG/W2XFtI848wwEvtMjr1WADfe1yxYlmqMC2yFsD4FAyRY1ncFjskDmzEvADLheSGQxFtQigyQqwD0l48PETlQTJIi12QD0KsKXGcr9JT53NDmlp2fiepLAt0lrfrQz5PF3ogLaoeDfQcu9z7hI4fv1ow7xXBqp6L7G2tIRnyZeqBLvLWwovN3ZIH/RjPLFnO6Au37Al3XbA63TiNn2onr4PALmhYI8bM/scrTAiv5Dx4687TREyr6rSeEPAzpditsYAKWHvo8RhpDRqx06tGwJ2gMW7dEJIaYxJMqA3WaRXazKuMkDS+35hhyMU59mSB7whzGI/hgV+LKHxuvdsi3SNFuiyZy+J9wD5cL6OcepOPM8GejfIh+0O+KVoZUYWZZH2O6DNsjxVyBWvTsC6SeopirAPuzxzdZCBLtctzlC3awmDJLCr8KQ1hQKPq4W0zdMtml7tkP8sLQhXUKFQHO2QflI2fCgIwlH+q37U3ZqnK+OCliqgBf5L9Z2Bfg7Gzm2pkFpXPY2L5W2mCmnBtmNnt8aFLVM0P+/dR4FMFiq1jZUM0qPVvrBOGKHVmnt4En7xDx1jiKZrNK70Y2xWnJdWitlXxbFpsXi9n3ePmE6LjEgK6YC2eTJ0pJaieZAYNi2LY0+e0dv7A22L0vRyK5YfI8hHZLAxNSgRbKDNsesfHhlYpKcE9C6fRqZMWXi8SXl13SL/EftL9dw7YmTF16eRpEXyoBbPBt4Xx4as7nj26N0yED7v00gti6wKsL8wMYTIea8ejbTUSLOIBfrNl5FW5PONgmLBBnoxzr0LhfBSj6D3yBgQGXJQXOTNUJ5naoCOA1tqI3Hua5Fv8Pb+UFzUy1Rns9p6WtKK1gCqthAVp+rngJ/z8u5Ia//XBC9dP9qdPrVmamnDdsCb9D2ZehBnT+jP4N0ePPqgdBAZZWnVs6XgJe1nHkDfUclukwN6S99ouMB4kMZKjUW+V/99eeWAqy2SyWmn5BZ5vfGkJJ4drYkC7dD9BdOOqqe0Ueemerwudpg6g22RisrefMBBOCXWw2tP+SzwRp/HvMWFXWqmoe2Dsox1rLSzRou02NTJBiYL9KyyNz+S4NE7m1UHR6AeaV4xdbCBSbP+LovENbUa9JZ04chcWBH2lv9S0qGwzQP4da2e7nJ1iz5WfLh1vvf3pQObViQpA/cpWSVQTdOB1zWyZ1ugt70190SeXTptQC2M5OsgZseGjPyKWrgY4EDC5Yqwe6ThcNCnfvFmF8kGvhhqKi/RH1YMJZukF87XSySFLU02Fvk2MxgqAM8oH1aiGfs2SJtWLYu6UiAKcuzUYQNtb80XLzODqVaYYzXbX11vDwJeI409Ud9FrjhRaghSSJKRPmrlaqEL5DNp0nHIn5Tnxsm7WI+6aIXsfzH1IBl9HdIT0ckvysBdbZcKbAv0QJrxuGrJDEJz16pLcjVEM3wCyc/aId3nc8HXpejZcZfFUpfENQknWptyXObZlZXPz0GZ4EuD9mB6doDFi+p5m4earJxnF508EJ1Tl3l2CmqSfSfR8WhIP6YYQnY65CcrzSKGlGf3sRg8uXSwiRxyRfu1wFrg32UbsUN6OM4hg0MZdi91NktmV0pCeIns3YsSEeBvSjMI3htBjObrsuOLv3dA30oJV06LiXYtAN9YKBQnJSn6DBPY9aGGn2c3kurlCIxhobYMdnrKYKeoDHaKymCnqAx2ispgp6gMdoqqNoPM/odvCp4tZQENO5lM/7AzyCnAziCnADuDbPyrv4HvX90i9dkX3QkoAAAAAElFTkSuQmCC"/>
                                </defs>
                            </svg>
                        </span>
                    </div> 
                </div>
                <div>
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required class="inputs">
                </div>
            </div>
            <div class="formulario-terminos-boton">
                <div class="formulario-terminos">
                    <input type="checkbox">
                    <label for="terminos">Al marcar esta casilla, acepto las políticas de privacidad de la Clínica Veterinaria Patitas Contentas, donde se detalla cómo se recopilan, utilizan y protegen mis datos personales de acuerdo con las leyes aplicables. Entiendo y acepto que mi información puede ser procesada y utilizada de acuerdo con estas políticas.</label>
                </div>
                <input class="boton-formulario-azul" type="submit" value="REGISTRARME">
            </div>
        </form>
    </div>
</main>

<?php	
    include './includes/templates/footer.php';  
?>