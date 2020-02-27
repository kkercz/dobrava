<?php
require_once 'Dobrawa.php';

$translation = "";
if (isset($_GET["word"]) && $_GET["word"]) {
    $word = $_GET['word'];
    $dobrava = new Dobrawa();
    $translation = $dobrava->translate($word);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Dobrava -- algorytm tłumaczący z polskiego na prasłowiański </title>
        <link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
        <script>
        function setFocus() {
            document.query.word.focus();
        }
    </script>
    </head>
    <body onLoad="setFocus()">    
        <div id="Zapytanie">
            <div id="Zacheta"> Podaj polskie słowo</div>
        <form id="queryform" name="query" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <input id="wordinput" name="word" type="text"  value=""/>
            <input type="submit" name="" value="Transformuj"  />
            
        </form>
        </div>
        
        
        
       <?php if ($translation): ?> 
        <div id="Wynik">
        <p style="font-size: xx-large;"> <?php echo "$word &lt; &#42;$translation"; ?></p>
        <?php if (Dobrawa::$LOG): ?>
        <div id="Zjawiska"> <span style="text-decoration: underline;" >Zjawiska towarzyszące: </span>
            <ul title="Zjawiska:">
                <?php 
                foreach(Dobrawa::$LOG as $sen)
                    echo "<li>$sen</li>";
                ?>
            </ul>
        </div>
        
        <?php endif; ?>
        </div>
        
        <?php endif; ?>
    
        
    
     
        <div id="footer"> 
            <div id="fcontent">
                &copy; 2011 <a href="mailto:k.kercz@gmail.com">Krzysztof Kercz</a>
            </div>
        </div>
        
    </body>
</html>
