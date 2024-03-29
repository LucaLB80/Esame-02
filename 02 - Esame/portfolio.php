<?php
ini_set("auto_detect_line_endings", true); // per il fine linea su MAC

require_once('utility.php');

use MieClassi\utility as UT;


$file = "portfolio.json";
$arr = json_decode(UT ::leggiTesto($file));
$file1 = "nav_footer_portfolio.json";
$nav = json_decode(UT ::leggiTesto($file1));



?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="css/style_portfolio.min.css" type="text/css">
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
           <!-- <li><a id="home" href="Index.html" title= "Vai a Home">Home</a></li>
                <li><a id="work" href="Work.html" title= "Vai a Work">Work</a></li> -->
            </ul>
        </nav>
        <?php
            foreach ($nav->button as $link) {
                        printf('<div class="%s"><a  href="%s" title="%s" >%s</a></div>' ,$link->class, $link->href, $link->title, $link->testo);
                    }
        ?>
        <!-- <div class="button"><a href="Contatti.html" title= "Vai a Contatti">Scrivimi</a></div> -->
    </header>

<!--HOME---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

        <h1>I Progetti più recenti</h1>       
        <main>             
            <div class="container-home"> 
                <?php
                    foreach ($arr as $link) {
                    
                    printf('<div "%u"><a href="%s" title="%s" class="%s" >%s</a></div>' ,$link->id, $link->url,$link->title,$link->class,$link->nome);
                }
                ?>
              <!--  <div><a href="Work.html" class="item1">Cliente 1</a></div>  
                    <div><a href="Work.html" class="item2">Cliente 2</a></div>
                    <div><a href="Work.html" class="item3">Cliente 3</a></div>         
                    <div><a href="Work.html" class="item4">Cliente 4</a></div>
                    <div><a href="Work.html" class="item5">Cliente 5</a></div>
                    <div><a href="Work.html" class="item6">Cliente 6</a></div> -->
            </div>
       
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