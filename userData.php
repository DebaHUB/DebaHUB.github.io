<?php 
    // define variables and set to empty values
    //$nameErr = $emailErr = $genderErr = $websiteErr = "";    
    $nameErr = $emailErr = $messageErr = "";
    $name = $email = $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
        }
    }
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        }
    }
        
    // if (empty($_POST["website"])) {
    //     $website = "";
    // } else {
    //     $website = test_input($_POST["website"]);
    //     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    //     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    //     $websiteErr = "Invalid URL";
    //     }
    // }

    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }

    // if (empty($_POST["gender"])) {
    //     $genderErr = "Gender is required";
    // } else {
    //     $gender = test_input($_POST["gender"]);
    // }
    // }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Message: <textarea name="message" rows="5" cols="40"><?php echo $message;?></textarea>
        <br><br>
    </form>
</html>

<?php
    echo "<h2>User Data:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $message;
    echo "<br>";
?>