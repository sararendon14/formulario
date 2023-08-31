<?php
include("conexion.php")//Se incluyó el archivo de conexion y así podemos usar las variables creadas en ese momento
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $nitocc="";
        $nombre="";
        $direccion="";
        $telefono="";
        $fechaingreso="";
        $cupocredito="";
        $foto="";
        if (isset($_POST['buscar']))
        {
            $nitoccbuscar=$_POST['nitoccbus'];
            $consulta=$conexion->query("select * from tblcliente where nitocc='$nitoccbuscar'");
            while($resultadoconsulta=$consulta->fetch_array())
            {
                $nitocc=$resultadoconsulta[0];
                $nombre=$resultadoconsulta[1];
                $direccion=$resultadoconsulta[2];
                $telefono=$resultadoconsulta[3];
                $fechaingreso=$resultadoconsulta[4];
                $cupocredito=$resultadoconsulta[5];
                $foto=$resultadoconsulta[6];
            } 
        }

    ?>
</head>
<body>
    <center>
        <h2>Manipulacion de datos con PHP</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Buscar: </label>
            <input type="text" name="nitoccbus" id="" placeholder="Buscar Cliente">
            <input type="submit" value="Buscar" name="buscar">
            <br><br>
             <label for="">Nit o CC: </label>
            <input type="text" name="nitocc" placeholder="Ingrese nit o cedula del cliente" value="<?php echo $nitocc?>">
            <br><br>
             <label for="">Nombre: </label>
            <input type="text" name="nombre" id="" placeholder="Ingresa el nombre completo"value=" <?php echo $nombre?>">
            <br><br>
             <label for="">Dirección: </label>
            <input type="text" name="direccion" id="" placeholder="Ej: kra 84 # 33-20" value= " <?php echo $nombre?>">
            <br><br>
            <label for="">Telefono: </label>
            <input type="number" name="telefono" id="" placeholder="Ej: 3106832925" value="<?php echo $direccion?>">
            <br><br>
            <label for="">Fecha de ingreso: </label>
            <input type="date" name="fechaingreso" id="" placeholder="Fecha de ingreso" value="<?php echo $fechaingreso?>">
            <br><br>
            <label for="">Cupo del credito: </label>
            <input type="number" name="cupocredito" id="" placeholder="$ valor en pesos" value="<?php echo $cupocredito?>">
            <br><br>
            <label for="">Subir foto: </label>
            <input type="file" name="foto" id="" >
            <br><br>
            <label for="">Foto</label>
            <img src="<?php echo $foto?> alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Guardar Nuevo Cliente" name="guardar">
            <input type="submit" value="Lista Todos Los Clientes" name="listar">
            <input type="submit" value="Actualizar Cliente" name="actualizar">
            <input type="submit" value="Eliminar  Cliente" name="eliminar">
        </form>
    </center>
    <?php
        if(isset($_POST['guardar']))
        {
            //los datos de entrada almacenados en variables
            $nitocc=$_POST['nitocc'];
            $nombre=$_POST['nombre'];
            $direccion=$_POST['direccion'];
            $telefono=$_POST['telefono'];
            $fechaingreso=$_POST['fechaingreso'];
            $cupocredito=$_POST['cupocredito'];
            //Maneejo de archivos:
            $nombre_foto=$_FILES['foto']['name']; //Nombre de la foto
            $ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
            $foto='fotos/'.$nombre_foto; //ruta y nombre del archivo
            copy($ruta,$foto);//Guarda el archivo en una ruta especifica

            //Verificar que no existan valores duplicados para el campo de Nit o cedula
            $sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc='$nitocc' ORDER BY nitocc";
            if($resultado=mysqli_query($conexion, $sqlbuscar))
            {
                $nroregistros=mysqli_num_rows($resultado);
                if($nroregistros>0)
                {
                    echo "<script>alert('Ese NIT o CC ya existe!! pilas hp');</script>";
                }
                else
                {
                    mysqli_query($conexion,"INSERT INTO tblcliente(nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto)
                     VALUES ('$nitocc','$nombre', '$direccion', '$telefono', '$fechaingreso', '$cupocredito', '$foto')");
                }
                
                
            }

        }
    ?>
    
</body>
</html>