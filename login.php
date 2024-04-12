<?php
require_once('includes/config.php');
require_once('includes/classes/FormSanitizer.php');
require_once('includes/classes/Constants.php');
require_once('includes/classes/Account.php');

$account = new Account($con);

if (isset($_POST['submitButton'])) {

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);


    $success =  $account->login($username, $password);


    if ($success) {
        $_SESSION['userLoggedIn'] = $username;
        header('Location: index.php');
    }
}
function getInputValue($input)
{
    if (isset($_POST[$input])) {
        echo $_POST[$input];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>

<body>
    <div class="signInContainer">
        <div class="column">

            <div class="header">
                <img src="assets/images/Netflix.png" title="logo" alt="site logo">
                <h3>Sign In</h3>
                <span>to continue to Netflix</span>
            </div>

            <form action="" method="POST">

                <?php $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username") ?>" required>

                <input type="password" name="password" placeholder="Password" value="<?php getInputValue("password") ?>" required>

                <input type="submit" name="submitButton" value="LOGIN">
            </form>
            <a href="register.php" class="signInMessage">New to Netflix? Sign up here!</a>
        </div>
    </div>

</body>

</html>