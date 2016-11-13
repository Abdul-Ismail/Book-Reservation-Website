    <?php
session_start();
$username = $_SESSION['username'];
echo $username;

if(isset($_SESSION['username'])){
	echo '<table border="2">'."\n";
	$db = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	
	mysqli_select_db($db, "book") or die(mysqli_error());

		$result = mysqli_query($db, "SELECT booktitle, username, ISBN FROM books
        JOIN reserved USING (ISBN)
		   WHERE reserved='Y' AND username='$username'"); //partial search
           

        	while( $row = mysqli_fetch_row($result) ) 
	{
		echo("</td><td>");
		echo($row[0]);
		echo("</td><td>");
		echo($row[1]);
        echo("</td><td>");
		echo "<form method=\"post\"> <input type=\"submit\" value=\"Unreserve\" name=\"reserving\"> 
		<input type=\"hidden\" name=\"id\" value=\"$row[2]\" />  </form>";
		echo("</tr>\n"); 

	}
	
 if ( isset($_POST['id'])) {
			$var = $_POST['id']; //takes the value from the hidden input which correpsons to the isbn of the book
          
	         
		 
			  $sql = "UPDATE books SET reserved='N' WHERE ISBN='$var'"; //this will change N to Y, making it reserved
 			  $db->query($sql);
			  $sql = "INSERT INTO reserved (ISBN, username, reservedDate)
		               VALUES ('$var', '$username', '$date')";
		                 mysqli_query($db, $sql);
                               header('Location:  unreserve.php');
	  
	 }
	
		echo "</table>\n"; // will not go back in search box after result is found
			mysqli_close($db);
                
	}else echo "must login";

?>
