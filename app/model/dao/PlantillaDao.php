<?php

class ColectivoDao {
    
    public function traerColectivoLinea($linea){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM colectivo WHERE linea = :linea",array(':linea'=>$linea));
        $colectivo = null;
        
        if(count($data_table) == 1){                     
            foreach ($data_table as $clave => $valor) {
                $colectivo = new Colectivo( $data_table[$clave]["linea"], $data_table[$clave]["empresa"]);
            }
            return $colectivo;
        }else{
            throw new Exception('linea de colectivo invalida');
        }
    }
    
    public function traerColectivo($linea){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM colectivo WHERE linea = :linea",array(':linea'=>$linea));
        $colectivo = null;
        
        if(count($data_table) == 1){
            foreach ($data_table as $clave => $valor) {
                $colectivo = new Colectivo( $data_table[$clave]["linea"], $data_table[$clave]["empresa"]);
            }
        }    
            return $colectivo;
    }
    
}

?>