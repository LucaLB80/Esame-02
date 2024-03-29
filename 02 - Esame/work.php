<?php
ini_set("auto_detect_line_endings", true); // per il fine linea su MAC

require_once('utility.php');

use MieClassi\utility as UT;


$file = "nav_footer_work.json";
$nav = json_decode(UT ::leggiTesto($file));
$file1 = "portfolio.json";
$arr1 = json_decode(UT ::leggiTesto($file1));
$selezionato = UT::richiestaHTTP("idClente");





?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work in Progress</title>
    <link rel="stylesheet" href="./css/style_work.min.css" type="text/css">
</head>
<body>

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
        <?php
            foreach ($nav->button as $link) {
                        printf('<div class="%s"><a  href="%s" title="%s" >%s</a></div>' ,$link->class, $link->href, $link->title, $link->testo);
                    }
        ?>
    </header>

<!--HOME---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

        <main>        
        <?php
             
             foreach ($arr1 as $link) {
               if ($link->id == $selezionato)
             printf('<h1 "%s" >%s</h1>', $selezionato, $link->titolo);
         
            }
       
        ?>      
            <!-- <h1>Work in Progress</h1> -->
            
            <?php
             
             foreach ($arr1 as $link) {
               if ($link->id == $selezionato)
             printf('<img "%s" src="%s"  width="%s" class="%s" alt="%s">', $selezionato, $link->img,$link->width,$link->class1,$link->alt);
         
            }
       
        ?> 
            <!-- <img src="Immagini/laptop-and-phone.jpg" width="450" class="img-home" alt="BG"> -->
            <?php
             
                 foreach ($arr1 as $link) {
                   if ($link->id == $selezionato)
                 printf('<p "%s" class="%s">%s</p>', $selezionato, $link->class,$link->par);
             
                }
           
            ?> 
            <!-- <p class="lorem"> </p>  -->
       
       </main>

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
    </html>