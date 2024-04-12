<?php
require_once('includes/config.php');
require_once('includes/classes/FormSanitizer.php');
require_once('includes/classes/Constants.php');
require_once('includes/classes/Account.php');

$account = new Account($con);

if (isset($_POST['submitButton'])) {

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormString($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormString($_POST["email2"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success =  $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);


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
                <h3>Sign Up</h3>
                <span>to continue to Netflix</span>
            </div>

            <form action="" method="POST">
                <?php $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First Name" value="<?php getInputValue("firstName") ?>">

                <?php $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last Name" value="<?php getInputValue("lastName") ?>">

                <?php $account->getError(Constants::$usernameCharacters); ?>
                <?php $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username") ?>">

                <?php $account->getError(Constants::$emailsDontMatch); ?>
                <?php $account->getError(Constants::$emailInvalid); ?>
                <?php $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email") ?>">

                <input type="email" name="email2" placeholder="Confirm Email" value="<?php getInputValue("email2") ?>">

                <?php $account->getError(Constants::$passwordsDontMatch); ?>
                <?php $account->getError(Constants::$passwordCharacters); ?>
                <input type="password" name="password" placeholder="Password">

                <input type="password" name="password2" placeholder="Confirm Password">

                <input type="submit" name="submitButton" value="SIGN UP">
            </form>
            <a href="login.php" class="signInMessage">Already have an Account? Sign in here!</a>
        </div>
    </div>

</body>

</html>