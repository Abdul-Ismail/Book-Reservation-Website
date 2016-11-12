<?php

	echo '<table border="2">'."\n";
	$db = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	
	mysqli_select_db($db, "book") or die(mysqli_error());
	
	if ( isset($_POST['title'])) {
		$title = $_POST['title'];
		$author= $_POST['author'];
		$result = mysqli_query($db, "SELECT booktitle, author, categoryID FROM books
		   WHERE booktitle like '%$title%' AND author like '%$author%'"); //partial search

        	while( $row = mysqli_fetch_row($result) ) 
	{
		echo("</td><td>");
		echo($row[0]);
		echo("</td><td>");
		echo($row[1]);
		echo("</td><td>");
		echo($row[2]);
		echo("</tr>\n");

	}
    
	} 
	
	echo "</table>\n"; // will not go back in search box after result is found

	mysqli_close($db);
?>

<p>Search single product:</p>

	<form method="post">
		<p>book title: 	<input type="text" name="title"></p>
		<p>author: 	<input type="text" name="author"></p>
		<p><input type="submit" value="Submit"/></p>
	</form>