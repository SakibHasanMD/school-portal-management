<?php if (isset($_GET['log-out'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }?>


<!DOCTYPE html>
<head>
    <title>Login To School Management</title>
</head>
<body>
	<center><h1>Admin Features By Job Holder</h1>
	<form method="get">
		<button type="submit" name="log-out">Logout</button>
	</form><br><br>

	</center>

</body>
</html>