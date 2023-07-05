

<?php 
class articulos{
    public function insertaArticulo($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $fecha=date('Y-m-d');

        $sql="INSERT into articulos (id_categoria,
                                    id_usuario,
                                    nombre,
                                    descripcion,
                                    cantidad,
                                    precio,
                                    fechaCaptura) 
                        values ('$datos[0]',
                                '$datos[1]',
                                '$datos[2]',
                                '$datos[3]',
                                '$datos[4]',
                                '$datos[5]',
                                '$fecha')";
        return mysqli_query($conexion,$sql);
    }

    public function obtenDatosArticulo($idarticulo){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="SELECT id_producto, 
                    id_categoria, 
                    nombre,
                    descripcion,
                    cantidad,
                    precio 
            from articulos 
            where id_producto='$idarticulo'";
        $result=mysqli_query($conexion,$sql);

        $ver=mysqli_fetch_row($result);

        $datos=array(
            "id_producto" => $ver[0],
            "id_categoria" => $ver[1],
            "nombre" => $ver[2],
            "descripcion" => $ver[3],
            "cantidad" => $ver[4],
            "precio" => $ver[5]
        );

        return $datos;
    }

    public function actualizaArticulo($datos){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="UPDATE articulos set id_categoria='$datos[1]', 
                                    nombre='$datos[2]',
                                    descripcion='$datos[3]',
                                    cantidad='$datos[4]',
                                    precio='$datos[5]'
            where id_producto='$datos[0]'";

        return mysqli_query($conexion,$sql);
    }

    public function eliminaArticulo($idarticulo){
        $c=new conectar();
        $conexion=$c->conexion();

        $sql="DELETE from articulos 
                where id_producto='$idarticulo'";
        $result=mysqli_query($conexion,$sql);

        if($result){
            return 1;
        }
    }
}
?>