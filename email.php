<?php
	/*
		0 = school
		1 = kinder-garden
	 */
	$contactType = $_GET["contact-type"];
	var_dump($contactType);
	/*
		0 = Camille
		1 = Arthur
	 */
	$child = $_GET["child"];
	var_dump($cchild);


				// 	<label for="contact-type">Contacter</label>
				// <input type="checkbox" name="contact-type[]" value="school">Ecole</input>
				// <input type="checkbox" name="contact-type[]" value="kinder-garden">Centre de loisirs</input>
				// <br>
				// <label for="child">Enfant</label>
				// <input type="checkbox" name="child[]" value="camille">Camille</input>
				// <input type="checkbox" name="child[]" value="arthur">Arthur</input>
				// <br>
				// <input type="radio" name="go-nogo[]" value="go">Ira</input>
				// <input type="radio" name="go-nogo[]" value="nogo">N'ira pas</input>
				// <label for="date">Date</label>
				// <input type="date" name="date" placeholder="jj/mm/aaa">
				// <input type="submit" value="Envoyer le mail">

?>