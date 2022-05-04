<?php

/**
 * Description of Tv
 * aqui va la descripción de la clase Tv... todo ,lo extensa que uno quiera
 * @author sergi
 */
class Tv {

    // <editor-fold defaultstate="collapsed" desc="propiedades (atributos o 
    // campos) privadas"> propiedades o campos de la clase Tv
    //se han declarado privadas, sólo se tiene acceso dentro de la clase.
    
    private $marca, //contendrá la marca, una cadena 
            $onOff, //TRUE (encendida) o FALSE (apagada)
            $canal, //número entero con el canal en el que está
            $volumen, //número entero con el valor del volumen actual
            $consumo, //número entero con el consumo de la tele
            $pulgadas, //número entero con las pulgadas de la tele
            $precio; //número float con el precio de la tele

    // </editor-fold>
    //constructor

    public function __construct($marca, $precio, $pulgadas) {
        //asigno los valores a los campos
        $this->marca = $marca;
        $this->precio = $precio;
        $this->pulgadas = $pulgadas;
        
        //valores inicales
        $this->onOff = FALSE;
        $this->consumo = 25;
        $this->canal = 1;
        $this->volumen = 10;
    }

    // <editor-fold defaultstate="collapsed" desc="getters">
    
    public function getMarca() {
        return $this->marca;
    }

    public function getOnOff() {
        return $this->onOff;
    }

    public function getCanal() {
        return $this->canal;
    }

    public function getVolumen() {
        return $this->volumen;
    }

    public function getPulgadas() {
        return $this->pulgadas;
    }

    public function getConsumo() {
        return $this->consumo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setters">

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setPulgadas($pulgadas) {
        $this->pulgadas = $pulgadas;
    }

    public function setConsumo($consumo) {
        $this->consumo = $consumo;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="métodos públicos">
    /**
     * establece a FALSE la propiedad onOff
     */
    public function apagar() {
        $this->onOff = FALSE;
    }

    //establece a TRUE la propiedad onOff
    public function encender() {
        $this->subeConsumo();
        $this->onOff = TRUE;
    }

    //    El volumen maximo es 100
    public function subirVolumen() {
        $this->subeConsumo();
        if (($this->onOff) && ($this->volumen < 100)) {
            $this->volumen++;
        }
    }

    //    El volumen minimo es 0
    public function bajarVolumen() {
//        $this->subeConsumo();
        if (($this->onOff) && ($this->volumen > 0)) {
                $this->volumen--;
        }
    }
    
    public function mutear() {
        if ($this->onOff) {
            $this->volumen = 0;
        }
    }

    // Canal maximo 10
    public function subirCanal() {
        if (($this->onOff) && ($this->canal < 10)) {
            $this->canal++;
        }
    }

    // canal minimo 0
    public function bajarCanal() {
        if (($this->onOff) && ($this->canal > 0)) {
            $this->canal--;
        }
    }

    /**
     * Establece a $valorCanal la propiedad $canal
     * @param entero $valorCanal indica el número de canal a poner
     */
    public function ponerCanal($valorCanal) {

        if ($valorCanal >= 0 AND $valorCanal <= 10) {
            $this->canal = $valorCanal;
        }
    }

    public function procesaOrden($orden) {
        //si es cambiar de canal... 
        if (($orden >= '1') && ($orden <= '9')) {
            $this->ponerCanal($orden);
        }

        switch ($orden) {
            // Control de volumen
            case "V+": $this->subirVolumen();
                break;
            case "V-": $this->bajarVolumen();
                break;
            case "M": $this->mutear();
                break;
            // Control de encendido
            case "off": $this->apagar();
                break;
            case "on": $this->encender();
                break;
            // Control de canal
            case "C+": $this->subirCanal();
                break;
            case "C-": $this->bajarCanal();
                break;
        }
    }

    /**
     * devuelve un mensaje con el estado actual de volumen y canal, 
     * o de "apagada" si no está encendida
     * @return string
     */
    public function estadoActual() {
        
        $mensaje = "<table border=1>";
        $mensaje .= "<tr>";
        
        //si la tele ($this) está encendida
        if ($this->onOff == TRUE) {
            //devuelve una cadena con el canal y el volumen
            $mensaje .= "<td>canal: $this->canal</td>"
                      . "<td>volumen: $this->volumen</td>";
        } else {
            //es que está apagada
            $mensaje .= "<td><b>apagada</b></td>";
        }
        $mensaje .= "</tr>";
        $mensaje .= "</table>";
        
        //devuelve el mensaje!
        return $mensaje;
    }

//devuelve los datos técnicos del objeto Tv creado
    public function informacionTecnica() {
        return "Marca: $this->marca <br/> "
                . "PVP: $this->precio €<br/>"
                . "Pulgadas: $this->pulgadas<br/>" .
                "Consumo : $this->consumo watios<br/>";
    }

// </editor-fold>
//un metodo privado
    private function subeConsumo() {
        $this->consumo = round((1.30 * $this->consumo), 0);
    }

}
