<?php

	class EMail
	{
	    private $child;
	    private $goNogo;
	    private $date = "";
	    private $mailCC = "gpungeot@gmail.com,sicardstephanie@gmail.com";
	    private static $mailBodyParts = array(
	    	"genericStart" => "Bonjour,\nPour information mon enfant ",
			"go" => "ira ",
			"noGo" => "n'ira pas ",
			"genericKinderGarden" => "au centre de loisirs le ",
			"genericRegards" => ".\n\nBonne journée.\nCordialement\nGuillaume Pungeot",
			);

	    private $mailBody = array();
	    private $mailTo = array();
	    private $mailChild = array();
	    private $mailTitle = "";
	    private $nbMails = 0;

	    public function __construct($child, $goNogo, $date)
	    {
	       	$this->child = $child;
	    	$this->goNogo = $goNogo;
	    	$this->date = DateTime::createFromFormat("d-m-Y", $date);

			for($i = 0; $i < count($this->child); $i++)
			{
				$this->nbMails++;
				$this->mailBody[$i] = self::$mailBodyParts["genericStart"];
				switch ($this->child[$i])
				{
					case 0:
						$this->mailChild[$i] = "Camille";
						$this->mailTitle[$i] = "CLP Camille Pungeot ".$this->date->format("d/m/Y");
						//$this->mailTo[$i] = "gpungeot@gmail.com";
						$this->mailTo[$i] = " Periscolaire Louveciennes <perisco@louveciennes.fr>, centre de loisirs primaire <clp@louveciennes.fr>, Ecole Leclerc - Primaire <0780595Y@ac-versailles.fr>";
						$this->mailBody[$i] .= "Camille Pungeot ";
						break;
					
					case 1:
						$this->mailChild[$i] = "Arthur";
						$this->mailTitle[$i] = "CLM Arthur Pungeot ".$this->date->format("d/m/Y");
						//$this->mailTo[$i] = "gpungeot@gmail.com";
						$this->mailTo[$i] = " Périscolaire Louveciennes <perisco@louveciennes.fr>, Maîtresse Arthur MS <0782434x@ac-versailles.fr>, Centre De Loisirs Maternelle Louveciennes <clm@louveciennes.fr>";
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

	    public function printMail()
	    {
            for($i = 0; $i < $this->nbMails; $i++)
	    	{
	    		$url = "to=".urlencode($this->mailTo[$i])."&cc=".urlencode($this->mailCC)."&subject=".urlencode($this->mailTitle[$i])."&body=".urlencode($this->mailBody[$i]);
	    		echo <<<EOT
	    		<div class="media col-md-3 col-xs-3">
                    <figure class="pull-left">
                        <img class="media-object img-circle img-responsive"  src="images/{$this->mailChild[$i]}.png">
                    </figure>
                </div>
                <div class="col-md-6">
                    <h4 class="list-group-item-heading"> {$this->mailTitle[$i]} </h4>
                    <p class="list-group-item-text"> <strong>To : </strong>{$this->mailTo[$i]}</p>
                    <p class="list-group-item-text"> <strong>Cc : </strong>{$this->mailCC}</p>
                    <br>
                    <p class="list-group-item-text"> {$this->mailBody[$i]}</p>
                </div>
                <div class="text-center">
                    <a  type="button" href="mailto:?{$url}" target="_blank" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-envelope"></span> Envoyer </a>
                </div>
EOT;
	    	}
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="/external_libraries/jquery-3.2.0.js"></script>
	<script type="text/javascript" src="/external_libraries/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="/external_libraries/bootstrap-3.3.7-dist/css/bootstrap.css">
</head>
	<body>
		<header class="container-fluid">

			<h1><a href="index.html" type="button" class="btn btn-lg"><span class="glyphicon glyphicon-home"></span></a>Envoi des mails</h1>
		</header>

		<div class="list-group">

<?php
	$mail->printMail();
?>
		</div>
	</body>
</html>
