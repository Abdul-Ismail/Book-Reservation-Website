<?php

	$db = mysqli_connect('localhost', 'root', '') or die(mysql_error());
	mysqli_select_db($db, "labdb") or die(mysqli_error());
	if ( isset($_POST['submit']))
	{
       foreach($_POST as $key => $value) { //checks if all values have been filled
            if(empty($value)) {
            echo "Error, not all values given.";
            die;
            }
      }

   if ($_POST['password'] === $_POST['password_confirmation']){ //checks if the two passwords entered are the same
		$a = $_POST['firstname'];
        $b = $_POST['surname'];
        $c = $_POST['email'];
		$d = $_POST['username'];
		$e = $_POST['password'];
		$f = $_POST['password_confirmation'];
		$sql = "INSERT INTO accounts (firstname, surname, email, username, password, password_confirmation)
		VALUES ('$a', '$b', '$c', '$d', '$e', '$f')";
		echo "<pre>\n$sql\n</pre>\n";
		mysqli_query($db, $sql);
    }else echo "password does not match"; //if the two passwords entered are not the same
	}
?>

<p>Enter account details:</p>

	<form method="post">
		<p>First Name:    <input type="text" name="firstname"></p>
        <p>Surname:    <input type="text" name="surname"></p>
		<p>Email:	    <input type="text" name="email"></p>
        <p>username:	    <input type="text" name="username"></p>
        <p>password:	    <input type="password" name="password"></p>
        <p>confirm password:	    <input type="password" name="password_confirmation"></p>
		<p><input type="submit" name ="submit" value="Submit"/></p>
	</form>