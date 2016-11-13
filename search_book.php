
<?php
session_start();
$username = $_SESSION['username'];
$date = date( 'Y-m-d');

if(isset($_SESSION['username'])){
	echo '<table border="2">'."\n";
	$db = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	
	mysqli_select_db($db, "book") or die(mysqli_error());

	
	if ( isset($_POST['title'])) {
		$title = $_POST['title'];
		$author= $_POST['author'];
		$selected = $_POST['description'];
		$result = mysqli_query($db, "SELECT booktitle, author, categoryID, ISBN FROM books
		   WHERE booktitle like '%$title%' AND author like '%$author%' AND categoryID='$selected' "); //partial search

        	while( $row = mysqli_fetch_row($result) ) 
	{
		echo("</td><td>");
		echo($row[0]);
		echo("</td><td>");
		echo($row[1]);
		echo("</td><td>"); 
		echo($row[2]);
		echo("</td><td>");
		echo "<form method=\"post\"> <input type=\"submit\" value=\"Reserve\" name=\"reserving\"> 
		<input type=\"hidden\" name=\"id\" value=\"$row[3]\" />  </form>";
		echo("</tr>\n"); 

	}

	}
 if ( isset($_POST['id'])) {
			$var = $_POST['id']; //takes the value from the hidden input which correpsons to the isbn of the book
          
		 $result = mysqli_query($db, "SELECT reserved FROM books WHERE ISBN='$var'"); //check reservation status of book picked
		 	$row = mysqli_fetch_row($result) ; //stores reserved value for book chosen
	         
		  if ($row[0] == 'N'){ //if book is not reserved
			  $sql = "UPDATE books SET reserved='Y' WHERE ISBN='$var'"; //this will change N to Y, making it reserved
 			  $db->query($sql);
			  $sql = "INSERT INTO reserved (ISBN, username, reservedDate)
		               VALUES ('$var', '$username', '$date')";
		                 mysqli_query($db, $sql);
			 }else echo "book is already reserved";


			  
	 }
	
		echo "</table>\n"; // will not go back in search box after result is found
			mysqli_close($db);
	}else echo "must login";



?>

<p>Search single product:</p>

	<form method="post">
		<p>book title: 	<input type="text" name="title"></p>
		<p>author: 	<input type="text" name="author"></p>
				<p>book description: </p>
		<select name="description" default="null">

  <option value="001" >Health</option>
  <option value="002" >Business</option>
  <option value="003" >Biography</option>
  <option value="004" >Technology</option>
  <option value="005" >Travel</option>
</select>

	<p><input type="submit" value="Submit"/></p>
	</form>