<?php

	$db = mysqli_connect('localhost', 'root', '') or die(mysql_error());
	mysqli_select_db($db, "book") or die(mysqli_error());
	if ( isset($_POST['submit']))
	{
       foreach($_POST as $key => $value) { //checks if all values have been filled
            if(empty($value)) {
            echo "Error, not all values given.";
            die;
            }
      }

   if ($_POST['password'] === $_POST['password_confirmation']){ //checks if the two passwords entered are the same
		$a = $_POST['username'];
        $b = $_POST['password'];
        $c = $_POST['firstname'];
		$d = $_POST['surname'];
		$e = $_POST['email'];
		$sql = "INSERT INTO users (username, password, firstname, surname, email)
		VALUES ('$a', '$b', '$c', '$d', '$e')";
		echo "<pre>\n$sql\n</pre>\n";
		mysqli_query($db, $sql);
    }else echo "password does not match"; //if the two passwords entered are not the same
	}
?>

<p>Enter account details:</p>

	<form method="post">
	    <p>username:	    <input type="text" name="username"></p>
		<p>password:	    <input type="password" name="password"></p>
		<p>confirm password:	    <input type="password" name="password_confirmation"></p>
		<p>First Name:    <input type="text" name="firstname"></p>
        <p>Surname:    <input type="text" name="surname"></p>
		<p>Email:	    <input type="text" name="email"></p>
		<p><input type="submit" name ="submit" value="Submit"/></p>
	</form>