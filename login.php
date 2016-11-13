<?php
session_start();
?>
<?php

include 'setDatabase.php';

if (isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1 ";
    $res = mysqli_query($db, $sql);
    if (mysqli_num_rows($res) == 1) {
        echo "You have successfully logged in.";
        $_SESSION['username'] = $username;
            header('Location:  search_book.php');
        exit();
    } else {
        echo "Invalid login information.";
        exit();
    }
    }



?>
<html>
<head>
</head>

<body>
<p>Sign Up:</p>

	<form method="post" action="login.php">
		<p>Name:	<input type="text" name="username"> </p>
		<p>Password: <input type="password" name="password"></p>
		<p><input type="submit" name ="submit" value="Log iN"/></p>
	</form>
	</body>

	</html>