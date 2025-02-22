 <!DOCTYPE html>
<head>
    <title>Register To School Management</title>
</head>
<body>
	
    <form action="index.php" method="post">
    	<fieldset>
            <legend><h1>Register New Account</h1></legend>
            <div style="align-content: left; padding-left: 30px">
        <label>Full Name:</label>
        <input type="text" id="register-username" name="register-username" required>
        
        <br>
        <br>


  		<label>Phone Number:</label>
        <input type="password" id="register-password" name="register-password" required>

        <br>
        <br>
        <label>Select a Role:</label>
    
   		 <select id="Role" name="Role">
        <?php
            // Array of cities
            $cities = array("Student", "Teacher");

            // Loop through the array to generate options
            foreach ($cities as $city) {
                echo "<option value='" . strtolower(str_replace(' ', '-', $city)) . "'>$city</option>";
            }
        ?>
    </select>

        
        <br>
        <br>
        <label>Password:</label>
        <input type="password" id="register-password" name="register-password" required>
        
        <br>
        <br>
        <label>Confirm Password:</label>
        <input type="password" id="register-password" name="register-password" required>

        <br>
        <br>

        <button type="submit" name="register">Register</button>
    </form>

     <p>Already have an account? <a href="http://localhost/School%20Management%20Project-%20Principal/login.php">Login here</a></p>
     	</fieldset>
 
    </div>
</body>
</html>
