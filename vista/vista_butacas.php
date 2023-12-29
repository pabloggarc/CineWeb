<div>
    <h1>Sala <?php echo $nombre_sala; ?></h1>
    <table class = "table" name = "tabla_butacas" id = "tabla_puestos">
    <?php
        for($i = 0; $i < $filas; $i++){
            echo "<tr>";
            for($j = 0; $j < $columnas; $j++){
                $id_butaca = $i * $columnas + $j;
                echo "<td class = 'butaca' id = '".$id_butaca."'>".($id_butaca + 1)."</td>";
                if($j + 1 == $columnas/2){
                    echo "<td class = 'pasillo'>".str_repeat("&nbsp", PASILLO_SIZE)."</td>";
                }
            }
            echo "</tr>";
        }
    ?>
    </table>
</div>