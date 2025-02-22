<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title>Login to School Portal Management</title>
   <style>
    body {
  
      align-items: center;
      margin-top: 90px;
      padding: 10px;
      font-family: 'Arial', sans-serif;
      
     
    }

    form {
      width: 400px;
      margin-left: 40px ;
      padding: 20px;
    }

    fieldset {
      border: 1px solid #ccc;
      padding: 20px;
    }

    legend {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #5D455F;
      font-weight: bold;
    }
    h1 {

        color: #3059FF ;
    }
img {
            max-width: 100%;
            height: auto;
            
        }
    table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;

        }

        td {
            border: none;
            padding: 8px;
            
        }

        td.column1 {
            width: 30%;
            height: 100%;

        }

        td.column2 {
            width: 70%;
            height: 100%;
        }


    input {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px ;
      background-color: #BEDBF9;
    }

    button {
      width: 96%;
      padding: 10px;
      background-color: #324D90;
      color: white;
      border: 1px solid #007bff;
      border-radius: 5px;
    }
     button:hover {
            background-color: #45a049;
        }

    a {
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
            text-decoration: underline;
            color: #009bff;
        }

  .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

.alert.hidden {
    display: none;
}


  </style>

  <script>
        function validateForm() {
            var id = document.getElementById('logusername').value;
            var password = document.getElementById('logpassword').value;

            if (id === '') {
               document.getElementById('error_message').innerHTML = 'Please enter User ID';
                document.getElementById("error_message").style.display = "block";
                return false;
            }
            else if(password === ''){
                document.getElementById('error_message').innerHTML = 'Please enter Password';
                document.getElementById("error_message").style.display = "block";
                return false;
            }
            return true;
        }
    </script>
  <style>
    /* Your existing styles here */
  </style>
</head>
<body>

<table>
  <tr>
    <td class="column1">
      <form method="post" action="../Controller/controller_login.php" onsubmit="return validateForm()">
        <?php
      
      if(isset($_SESSION['error_message'])){
        echo "
    <div class='alert'>
        <span  class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
        <strong id='error_message'>" . $_SESSION['error_message'] . "</strong>
    </div>";
         unset($_SESSION['error_message']);
      }

      else{
        echo "
     <strong>
     <div class='alert hidden' id='error_message'>
     <span  class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
     </div></strong>";
      }
     
     ?>
     <br>
        <h1>Wecome to School Portal Management! </h1>
        <label for="logusername">User ID:</label>
        <input type="text" name="logusername" id="logusername" >
        <br><br>
        <label for="logpassword">Password:</label>
        <input type="password" name="logpassword" id="logpassword" >
        <br><br>
        <button type="submit" name="login" >Login</button>

        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
      </form>
    </td>
    <td class="column2"><center> <img src="https://img.freepik.com/free-vector/education-learning-concept-love-reading-people-reading-students-studying-preparing-examination-library-book-lovers-readers-modern-literature-flat-cartoon-vector-illustration_1150-60938.jpg" alt="Education Learning"></center></td>
  </tr>
</table>

</body>
</html>
