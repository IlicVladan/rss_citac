<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rss čitač</title>
	<style>
		img {
			width:398px;
			border: 1px solid black;
			}
	</style>
</head>
<body>
	<h1>Aplikacija - RSS čitač</h1>
    <form action="rss_citac.php" method="POST">
        <select name="link" id="link">
            <option value="0">Izaberite dnevni list</option>
            <option value="https://www.blic.rs/rss/danasnje-vesti">Blic</option>
            <option value="https://www.kurir.rs/rss">Kurir</option>
            <option value="https://www.novosti.rs/rss/danasnje-vesti">Novosti</option>
            <option value="https://informer.rs/rss/danasnje-vesti">Informer</option>
            <option value="https://www.politika.rs/rss/">Politika</option>
        </select>
        <button>Prikaži</button>
    </form>
<?php
    if(isset($_POST['link']) && $_POST['link']!='0')
    {
        $link=$_POST['link'];

        $xmlTekst=file_get_contents($link);
        $xml=new SimpleXMLElement($xmlTekst);
        $kanal=$xml->channel;
        echo "<h1>{$kanal->title}</h1>";
        echo "<h4>{$kanal->description}</h4>";
        echo "<div>{$kanal->pubDate}</div><br>";
        echo "Broj vesti: ".$kanal->item->count();
        echo "<hr>";
        $vesti=$kanal->item;
        $brojac=0;
        foreach($vesti as $vest)
        {
            echo "<div style='width:400px; margin:2px;padding:2px;border:1px solid black'>";
            echo "<h4>$vest->title</h4>";
            echo "<div>{$vest->description}</div><br>";
            echo "<div>{$vest->pubDate}</div>";
            echo "<a href='{$vest->link}' target='_blank'>Link</a>";
            echo "</div><br>";
            $brojac++;
            if($brojac==50) break;
        }

    }
    
?>
</body>
</html>
