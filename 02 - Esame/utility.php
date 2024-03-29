<?php

namespace MieClassi;

/**
 * Questa classe contiene tutti i metodi utili
 * @author Luca Basta
 * @copyright 2024
 * @license LGPL
 * @version 1.0.0
 */

 class utility
 {
    //------------------------------------------------------------
    /**
     * Funzione per controllare se una stringa sta all'interno di un range di lunghezza
     * 
     * @param string $stringa Stringa da controllare
     * @param integer $min Lunghezza minima
     * @param integer $max Lunghezza massima
     * @return boolean
     * 
     */
    public static function controllaRangeStringa($stringa, $min = null, $max = null)
    {
        $rit = 0;
        $n = strlen($stringa);
        if ($min != null && $n < $min) {
            $rit++;
        }
        if ($max != null && $n > $max) {
            $rit++;
        }
        return ($rit == 0);
    }
   //------------------------------------------------------------
   /**
    * Funzione per leggere del testo in un file
    *
    * @param string $file Nome del file
    * @return boolean|string
    *
    */
    public static function leggiTesto($file)
    {
        $rit = false;
        if (!$fp = fopen($file, 'r')) {
            echo "Non posso aprire il file $file<br>";
        } else {
            if (is_readable($file) === false) {
                echo "il file $file non è leggibile<br>";
            } else {
                $rit = fread($fp, filesize($file));               
            }
        }
        fclose($fp);
        return $rit;
    } 
    //------------------------------------------------------------
    /**
     * Funzione per leggere del testo di un file CSV
     *
     * @param string $file Nome del file
     * @return boolean|array
     *
     */
    public static function leggiTestoCSV($file)
    {
        $rit = false;
        $riga = 0;
        if (!$fp = fopen($file, 'r')) {
            echo "Non posso aprire il file $file<br>";
        } else {
            if (is_readable($file) === false) {
                echo "il file $file non è leggibile<br>";
            } else {
                while (($data = fgetcsv($fp, null, ";")) !== false)  {
                    $rit[$riga] = $data;
                    $riga++;
                }             
            }
        }
        fclose($fp);
        return $rit;
    }
   //------------------------------------------------------------
    /**
     * 
     * Funzione per estrarre dal $_POST o dal $_GET la propietà richiesta
     * 
     * @param string Propietà da ricercare
     * @return string|null
     * 
     */
    public static function richiestaHTTP($str)
    {
        $rit = null;
        if ($str !== null) {
            if (isset($_POST[$str])) {
                $rit = $_POST[$str];
            } elseif (isset($_GET[$str])) {
                $rit = $_GET[$str];
        }
    }  
        return $rit;
    }
    
    //------------------------------------------------------------------
    /**
     * Funzione per scrivere del testo in un file
     * 
     * @param string $file Nome del file
     * @param string $stringa Testo da inserire
     * @param boolean $commenta Scrive a video se l'operazione e'andata a buon fine
     * @return boolean
     * 
     */
    public static function scriviTesto($file, $stringa, $commenta = false)
    {
        $rit = false;
        if (!$fp = fopen($file, 'a')) {
            echo "Non posso aprire il file $file<br>";
        } else {
            if (is_writable($file) === false) {
                echo "il file $file non è scrivibile<br>";
            } else {
                if (!fwrite($fp, $stringa)) {
                    echo "<br>Non posso scrivere il file $file<br>";
                } else {
                    if ($commenta) echo "Operazione completata!<br> Ho scritto:<br>" .  str_repeat ("-",20) . "<br>" , $stringa , "<br>".  str_repeat ("-",20) . "<br>"  , "Nel file " ,  $file  , "<br>"  ;
                    $rit = true;
                }
            }
        }
        fclose($fp);
        return $rit;
    }   
}

define("Commenta", true);