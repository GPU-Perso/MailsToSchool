<?php

	class EMail
	{
	    private $child;
	    private $goNogo;
	    private $date = "";
	    private $mailCC = "gpungeot@gmail.com, sicardstephanie@gmail.com";
	    private $mailFrom = "gpungeot@gmail.com";
	    private static $mailBodyParts = array(
	    	"genericStart" => "Bonjour,\nPour information mon enfant ",
			"go" => "ira ",
			"noGo" => "n'ira pas ",
			"genericKinderGarden" => "au centre de loisirs le ",
			"genericRegards" => ".\n\nBonne journée.\nCordialement\nGuillaume Pungeot",
			);

	    private $mailBody = [];
	    private $mailTo = [];
	    private $mailTitle = "";
	    private $nbMails = 0;

	    public function __construct($child, $goNogo, $date)
	    {
	       	$this->child = $child;
	    	$this->goNogo = $goNogo;
	    	$this->date = DateTime::createFromFormat("Y-m-d", $date);

			for($i = 0; $i < count($this->child); $i++)
			{
				$this->nbMails++;
				$this->mailBody[$i] = self::$mailBodyParts["genericStart"];
				switch ($this->child[$i])
				{
					case 0:
						$this->mailTitle[$i] = "CLP Camille Pungeot ".$this->date->format("d/m/Y");
						//$this->mailTo[$i] = "gpungeot@gmail.com";
						$this->mailTo[$i] = "Periscolaire Louveciennes <perisco@louveciennes.fr>, centre de loisirs primaire <clp@louveciennes.fr>, Ecole Leclerc - Primaire <0780595Y@ac-versailles.fr>";
						$this->mailBody[$i] .= "Camille Pungeot ";
						break;
					
					case 1:
						$this->mailTitle[$i] = "CLM Arthur Pungeot ".$this->date->format("d/m/Y");
						//$this->mailTo[$i] = "gpungeot@gmail.com";
						$this->mailTo[$i] = "Périscolaire Louveciennes <perisco@louveciennes.fr>, Maîtresse Arthur MS <0782434x@ac-versailles.fr>, Centre De Loisirs Maternelle Louveciennes <clm@louveciennes.fr>";
						$this->mailBody[$i] .= "Arthur Pungeot ";
						break;
					
					default:
						die("Unknown child");
						break;
				}
		    	$this->mailBody[$i] .= $this->goNogo == 0 ? self::$mailBodyParts["go"] : self::$mailBodyParts["noGo"];
    			$this->mailBody[$i] .= self::$mailBodyParts["genericKinderGarden"].$this->date->format("d/m/Y");
    			$this->mailBody[$i] .= self::$mailBodyParts["genericRegards"];
	    	}
	    }
	    public function displayVar() {
	        echo $this->var;
	    }

	    public function print()
	    {
		    echo "<ol>";
	    	for($i = 0; $i < $this->nbMails; $i++)
	    	{
		    	echo "<li>";
		    	echo "<b>From : </b>".$this->mailFrom."<br>";
		    	echo "<b>To : </b>".$this->mailTo[$i]."<br>";
		    	echo "<b>CC : </b>".$this->mailCC."<br>";
		    	echo "<b>Title : </b>".$this->mailTitle[$i]."<br>";
		    	echo "<b>Body : </b>".$this->mailBody[$i];
		    	echo "<br><br>";
			    
			    $url = "to=".urlencode($this->mailTo[$i])."&cc=".urlencode($this->mailCC)."&subject=".urlencode($this->mailTitle[$i])."&body=".urlencode($this->mailBody[$i]);
			    // echo $url."<br>";
			    echo "<a href='mailto:?".$url."' target='_blank' class='submit'>Envoyer</a></li>";
	    	}
		    echo "</ol>";
	    }
	}

	if(!isset($_GET["child"]) || !isset($_GET["go-nogo"]) || !isset($_GET["date"]))
		die("Missing parameters");

	$mail = new Email($_GET["child"], $_GET["go-nogo"], $_GET["date"]);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Notification centre de loisirs</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>

<?php
	$mail->print();
?>

	</body>
</html>
