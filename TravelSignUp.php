



<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $first_name = $last_name=$email = "";
$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err=$email_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST['username']))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    


    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter your email.";     
  } else{
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        
        // Set parameters
        $param_email= trim($_POST["email"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "This email is already in use.";
            } else{
                $email = trim($_POST["email"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}








    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["first_name"]))){
      $first_name_err = "Please enter your firstname.";     
  } else{
      $first_name = trim($_POST["first_name"]);
  }

  if(empty(trim($_POST["last_name"]))){
    $last_name_err = "Please enter your lastname.";     
} else{
    $last_name = trim($_POST["last_name"]);
}
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err) && empty($email_err
    )){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username,first_name,last_name,email, password) VALUES (?, ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_first_name,$param_last_name,$param_email,$param_password);
            
            // Set parameters
            $param_username = $username;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: Travellogin.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
<link rel="stylesheet" href="TravelLoginStyle.css">
<link rel="stylesheet" href="Dashboard.css">
<head>
    <title>Login</title>
</head>
<body>

    <div class="nav">
        <div class="menu">
          <img src = "logo.jpg" width="50" height="50">
          <a href="index.php"> back</a>
        </div>
      </div>
<div class="box boxtop">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <span class="text-center">Sign Up</span>
        <div class="input-container">
            <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" />
            <label>User name</label>
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
            
        </div>
        <div class="input-container">
            <input type="text" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>" />
            <label>first name</label>
            <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
            
        </div>
        <div class="input-container">
            <input type="text" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>" />
            <label>Last name</label>
            <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
            
        </div>
        <div class="input-container">
            <input type="text" class = "form-control<?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" />
            <label>Email</label>
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="input-container">
        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                  <label>Password</label>
        </div>
        <div class="input-container">
        <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <button  type="submit" class="btn" >submit</button>
        <div class="signup">
            Already have an account? <a href="TravelLogin.html"> Sign in</a>
       </div>

       <div class="policy" >
        By registering you agree with the company Term of Service and Privacy Policy.
       </div>
    </form>
</div>
</body>
</html> 