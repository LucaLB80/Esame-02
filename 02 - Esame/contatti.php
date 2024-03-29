<?php
ini_set("auto_detect_line_endings", true); // per il fine linea su MAC

require_once('utility.php');

use MieClassi\utility as UT;


$file = "nav_footer_contatti.json";
$nav = json_decode(UT ::leggiTesto($file));
$inviato = UT::richiestaHTTP("inviato");
$inviato = ($inviato == null || $inviato != 1) ? false : true;



if ($inviato) {
    $valido = 0;
    // Recupero i dati
    $nome = UT::richiestaHTTP("nome");
    $cognome = UT::richiestaHTTP("cognome");
    $email = UT::richiestaHTTP("email");
    $telefono = UT::richiestaHTTP("telefono");
    $testo = UT::richiestaHTTP("text-area");

    $clsErrore = ' class="errore" ';


    //VALIDO I DATI
    if (($nome != "") && UT::controllaRangeStringa($nome, 0, 25)) {
        $clsErroreNome = "";
    } else {
        $valido++;
        $clsErroreNome = $clsErrore;
        $nome = "";
    }


    if (($cognome != "") && UT::controllaRangeStringa($cognome, 0, 25)) {
        $clsErroreCognome = "";
    } else {
        $valido++;
        $clsErroreCognome = $clsErrore;
        $cognome = "";
    }

    if (($email != "") && UT::controllaRangeStringa($email, 10, 100) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $clsErroreEmail = "";
    } else {
        $valido++;
        $clsErroreEmail = $clsErrore;
        $email = "";
    }

    if (($telefono != "") || UT::controllaRangeStringa($telefono, 5, 20)) {
        $clsErroreTelefono = "";
    } else {
        $valido++;
        $clsErroreTelefono = $clsErrore;
        $telefono = "";
    }
    // ($telefono == "") per non fare la validazione

    if (($testo != "") && UT::controllaRangeStringa($testo, 1, 500)) {
        $clsErroreTesto = "";
    } else {
        $valido++;
        $clsErroreTesto = $clsErrore;
        $testo = "";
    }

    $inviato = ($valido == 0) ? true : false;
} else {
    $nome = "";
    $cognome = "";
    $email = "";
    $telefono = "";
    $testo = "";

    $clsErroreNome = "";
    $clsErroreCognome = "";
    $clsErroreEmail = "";
    $clsErroreTelefono = "";
    $clsErroreTesto = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatti</title>
    <link rel="stylesheet" href="./css/style_contatti.min.css" type="text/css">
</head>
<body>
<?php
if (!$inviato) {
?> 
    <img src="./Immagini/blue_elegante.jpg" alt="BG" width="100%" class="bg">

<!--BARRA DI NAVIGAZIONE------------------------------------------------------------------------------------------------------------------------------------------------------------>


     <header>
        <img src="Immagini/Logo%20Luca.png" alt="logo" width="180" class="logo">
        <nav>
            <ul class="menu">
                <?php
                        foreach ($nav->header as $link) {
                            printf('<li><a id="%s" href="%s" title="%s" >%s</a></li>' ,$link->id, $link->href, $link->title, $link->testo);
                        }
                ?>
            </ul>
        </nav>
    </header>

<!--HOME---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

      <form action="contatti.php?inviato=1" method="POST" novalidate>
            <fieldset>
                    <div class="testo">
                        <h2>Compila il form per richiedere informazioni</h2>
                        <h4>Inserisci i tuoi contatti</h4>
                    </div>                    
                    <div><label for="nome" <?php echo $clsErroreNome; ?>>Nome</label></div>
                     <div><input type="text" id="nome" name="nome" placeholder="Nome" required maxlength="25" value="<?php echo $nome; ?>" /></div>  

                    <div><label for="cognome" <?php echo $clsErroreCognome; ?>>Cognome</div>
                    <div><input type="text" id="cognome" name="cognome" placeholder="Cognome" maxlength="25" value="<?php echo $cognome; ?>"/></div>

                    <div><label for="email" <?php echo $clsErroreEmail; ?>>E-mail</label></div>
                    <input type="email" id="email" name="email" placeholder="E-mail" required maxlength="40" minlength="10"  value="<?php echo $email; ?>" /></div>

                    <div><label for="tel" <?php echo $clsErroreTelefono; ?>>Telefono</label></div>
                    <div><input type="tel" id="telefono" name="telefono" placeholder="Telefono" maxlength="20" minlength="5" value="<?php echo $telefono; ?>" /></div>

                    <label for="text-area"<?php echo $clsErroreTesto; ?>>Testo</label>
                    <div><textarea id="text-area" name="text-area" rows="4" cols="50" placeholder="Scrivi un messaggio" required maxlength="500"><?php echo $testo; ?></textarea></div>
                    
                    <div class="a-button">
                    <?php
                        foreach ($nav->button as $link) {
                                    printf('<button class="%s" type="%s" title="%s"><a>%s</a></button>' ,$link->class, $link->type, $link->title, $link->testo);
                                }
                    ?>
                        <!-- <button class="button-1" type="submit" title="Clicca per inviare"><a>Invia</a></button>       -->
                    </div>    
            </fieldset>
      </form>   

<!--FOOTER--------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

        <footer>
            <div class="container">
                <div class="footer-contenuto">
                <h3>Contact</h3>
                <!-- <ul class="contact"> -->
                    <?php
                        foreach ($nav->contatti as $link) {
                            if($link->href == 'null') {
                                    printf('<p>%s</p>' ,$link->testo);
                                } else {
                                    printf('<li><a href="%s" title="%s" >%s</a></li>' ,$link->href,$link->title,$link->testo);
                                }
                        }
                    ?> 
                </div>
                <div class="footer-contenuto">
                    <h3 id="list">Quick Links</h3>
                    <ul class="list">
                    <?php
                        foreach ($nav->footer as $link) {
                            printf('<li><a href="%s" title="%s" >%s</a></li>' ,$link->href, $link->title, $link->testo);
                        }
                    ?>  
                    </ul>
                </div>
                <div class="footer-contenuto">
                    <img src="Immagini/Logo%20Luca.png" alt="logo" width="180" class="logo2">
                </div>
            </div>
            <div class="bottom-bar">
                <p>&copy; 2023. All rights reserved</p>
            </div>
       </footer>
    
</body>
<?php
        } else {
            $str =  "<strong>Nome:</strong> %s<br>" .
                    "<strong>Cognome:</strong> %s<br>" .
                    "<strong>E-Mail:</strong> %s<br>" .
                    "<strong>Telefono:</strong> %s<br>" .
                    "<strong>Testo:</strong> %s<br>" ;
            $str = sprintf($str, $nome, $cognome, $email,$telefono, $testo);
            echo "<h1>Grazie per averci contattato</h1> Ecco il riepilogo dei tuoi dati:<br><br>$str";

            $str = str_replace('<br>', chr(10), $str);

            $file = 'modulocontatto.txt';

            $str = str_repeat("-", 30) .  chr(10) . $str . chr(10) . str_repeat("-", 30) . chr(10);
            $rit = UT::scriviTesto($file, $str);

            if ($rit) {
                echo "<br>" . str_repeat("-", 30) . "<br>Modulo inviato correttamente<br>";
            } else {
                echo "<br>" . str_repeat("-", 30) . "<br>Problema nell'invio del modulo<br>";
            }
        }
        ?> 
</html>