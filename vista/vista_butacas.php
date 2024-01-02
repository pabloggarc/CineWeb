<h1>Sala <?php echo $nombre_sala; ?></h1>
<div class = "center-div">
    <table class="table" name="tabla_butacas" id="tabla_butacas">
        <?php
        for ($i = 0; $i < $filas; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $columnas; $j++) {
                $id_butaca = $i * $columnas + $j;

                if ($libre[$id_butaca] == 1) {
                    echo "<td class='butaca_libre' id='".($ids_butacas[$id_butaca])."'><i class='fas fa-couch'></i><br>".($id_butaca + 1)."</td>";
                } else {
                    echo "<td class='butaca_ocupada' id='".($ids_butacas[$id_butaca])."'><i class='fas fa-couch'></i><br>".($id_butaca + 1)."</td>";
                }
                if ($j + 1 == $columnas / 2) {
                    echo "<td class='pasillo'>".str_repeat("&nbsp", PASILLO_SIZE)."</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</div>
<button id="boton_conf_entradas">Confirmar entradas</button>