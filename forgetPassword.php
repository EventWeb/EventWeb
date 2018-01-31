<?php 
    session_start();

    // Connect to database
    $config = require('config.php');
    $dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
    try {
        $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    // variable declaration
	$email    = "";
	$errors = array(); 

    if (isset($_POST['submitEmail'])){
        $email = (isset($_POST['email']) ? $_POST['email'] : null);
        $sql = "SELECT email FROM user WHERE email='$email'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $email = $stmt->fetchAll();
        $count_email = count($email);
        
        if ($count_email==0){
            array_push($errors, "This email is not registered yet.");
        }
        else{
            $thisemail = $email[0]['email'];

            $sql = "SELECT name FROM user WHERE email='$thisemail'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $username = $stmt->fetchAll();
            $thisusername = $username[0]['name'];

            // generate new password
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $newpassword = implode($pass); //turn the array into a string

            /*
            To send email, please use SMTP server provided at https://github.com/rnwood/smtp4dev/releases/tag/v2.0.10
            Download smtp4dev-2.0.10.msi and run.
            */
            // send to email
            $to = "$thisemail";
            $subject = "EventWeb - Reset Password";
            $message = "
                <html>
                <head>
                <title>HTML email</title>
                </head>
                <body>
                <p>Username: $thisusername</p>
                <p>Email: $thisemail</p>
                <p>New Password: $newpassword</p>
                </body>
                </html>
            ";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: admin@eventweb.com";
            mail($to,$subject,$message,$headers);

            // update in database
            $password = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user
                    SET password = '$password'
                    WHERE email = '$thisemail'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //redirect to new page
            //header("location: changepwsuccess.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body class="forgetPass">
	<?php require('partials/header.php'); ?>
    <h2>Enter the Email of Your Account to Reset New Password</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>

    <div class="forgetContainer">
        <form method="post">
            <!-- display validation message-->
            <?php include('errors.php');?>
            <!-- display ends-->
            <div class="forgetForm">
                <input type="email" name="email" autocomplete="off" autofocus>
            </div>
            <input type="submit" name="submitEmail" value="Submit">
        </form>  
    </div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>