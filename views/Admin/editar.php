<?php
include_once "encabezado.php";
$mysqli = include_once "conexion.php";
$id = $_GET["Code"];
$sentencia = $mysqli->prepare("SELECT Code, Name, Continent, Region, Population, LocalName, GovernmentForm, HeadOfState FROM country WHERE Code = ?");
$sentencia->bind_param("s", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();
# Obtenemos solo una fila, que será el producto a editar
$producto = $resultado->fetch_assoc();
if (!$producto) {
    exit("No hay resultados para ese ID");
}
?>
<div class="row">
    <div class="col-12">
        <h1>Actualizar Producto</h1>
        <form action="actualizar.php" method="POST">

            <input type="hidden" name="Code" value="<?php echo $producto["Code"] ?>">

            <div class="form-group">
                <label for="Name">Nombre</label>
                <input value=<?php echo $producto["Name"] ?> placeholder="Name" class="form-control" type="text" name="Name" id="Name" require>
            </div>

            <div class="form-group">
                <label for="Continent">Continente</label>
                <input value=<?php echo $producto["Continent"] ?> placeholder="Continent" class="form-control" type="text" name="Continent" id="Continent" require>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input value=<?php echo $producto["Region"] ?> placeholder="Region" class="form-control" type="text" name="Region" id="Region" require>
            </div>

            <div class="form-group">
                <button class="btn btn-success">Guardar</button>
                <a class="btn btn-warning" href="listar.php">Volver</a>
            </div>
        </form>
    </div>
</div>
<?php include_once "pie.php"; ?>