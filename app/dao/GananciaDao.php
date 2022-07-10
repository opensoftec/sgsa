<?php

class GananciaDao {

    //funciones de acceso a datos
    public function totalVentaDia($fechaInicio,$fechaFin){
        try{
            $ventas = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select DATE_FORMAT(date(fecha), '%W') as Dia, date(fecha) as Fecha, sum(total) as Total from venta where date(fecha) between '".$fechaInicio."' and '".$fechaFin."' group by date(fecha)";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $ventas->append(array($rs->Dia, $rs->Fecha, $rs->Total));
            }
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $ventas;
    }

    public function totalCompraDia($fechaInicio,$fechaFin){
        try{
            $compras = new ArrayObject();
            $cn = DataConection::getInstancia();
            $query = "select DATE_FORMAT(date(fecha), '%W') as Dia, date(fecha) as Fecha, sum(total) as Total from compra where date(fecha) between '".$fechaInicio."' and '".$fechaFin."' group by date(fecha)";
            $stmt = $cn->prepare($query);
            $stmt->execute();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                $compras->append(array($rs->Dia, $rs->Fecha, $rs->Total));
            }
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $compras;
    }

    //funciones de tratamiento de datos
    public function Ganancia($fechaInicio,$fechaFin){
        /*$compras = $this->totalCompraDia($fechaInicio,$fechaFin);
        $ventas = $this->totalVentaDia($fechaInicio,$fechaFin);

        $ganancia = new ArrayObject();
        $compraFilas = $this->countFilas($compras);
        $ventaFilas = $this->countFilas($ventas);

        $ganancia = new ArrayObject();
        if ($ventaFilas >= $compraFilas){
            $ganancia = $this->VentavsCompra($ventas,$compras,'v');
        }else{
            $ganancia = $this->VentavsCompra($compra,$ventas,'c');
        }*/
        $dias = array("Domingo","Lunes","Martes","Miercoles;rcoles","Jueves","Viernes","Sabado");
        $ganancia = new ArrayObject();
        $tamArreglo = 0;
        
        $fecha = date('Y-m-d', strtotime($fechaInicio));
        $fechaF = date('Y-m-d', strtotime($fechaFin));
        
        while($fecha <= $fechaF){
            $tamArreglo += 1;
            $ganancia->append(array($dias[date('w', strtotime($fecha))], $fecha, 0.00, 0.00, 0.00));
            $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-d' , $nuevafecha);
        }

        $compras = $this->totalCompraDia($fechaInicio,$fechaFin);
        $ventas = $this->totalVentaDia($fechaInicio,$fechaFin);
        for($i=0 ; $i<$tamArreglo ; $i++){
            foreach ($ventas as $fila) {
                if ($ganancia[$i][1] == $fila[1]){
                    $ganancia[$i][2] = $fila[2];
                    break;
                }
            }
            foreach ($compras as $fila) {
                if ($ganancia[$i][1] == $fila[1]){
                    $ganancia[$i][3] = $fila[2];
                    break;
                }
            }
            $ganancia[$i][4] = $ganancia[$i][2]-$ganancia[$i][3]; 
        }
        return $ganancia;
    }

    public function prueba($fechaInicio,$fechaFin){
        $compras = $this->totalCompraDia($fechaInicio,$fechaFin);
        return $compras;
        
    }

    //cuenta las filas de un arreglo bidimensional
    public function countFilas($arreglo){
        $numFilas = 0;
        foreach ($arreglo as $fila) {
            $numFilas +=1;
        }
        return $numFilas;
    }

    //genera el arreglo bidimensional de Ventas vs Compra
    public function VentavsCompra($arregloMayor,$arregloMenor,$mayor){
        $arreglo = new ArrayObject();
        $alert = 0;
        foreach ($arregloMayor as $filaA) {
            foreach ($arregloMenor as $filaB) {
                $alert = 1;
                if ($filaA[1] == $filaB[1] && $mayor == 'v'){
                    $arreglo->append(array($filaA[0], $filaA[1], $filaA[2], $filaB[2], ($filaA[2]-$filaB[2])));
                    $alert = 0;
                    break;
                }elseif ($filaA[1] == $filaB[1] && $mayor == 'c') {
                    $arreglo->append(array($filaA[0], $filaA[1], $filaB[2], $filaA[2], ($filaB[2]-$filaA[2])));
                    break;
                    $alert = 0;
                }
            }

            if ($alert == 1 && $mayor == 'v'){
                $arreglo->append(array($filaA[0], $filaA[1], $filaA[2], '0.00', ($filaA[2]-0)));
                $alert = 0;
            }elseif ($alert == 1 && $mayor == 'c') {
                $arreglo->append(array($filaA[0], $filaA[1], '0.00', $filaA[2], (0-$filaA[2])));
                $alert = 0;
            }
        }
        return $arreglo;
    }
}