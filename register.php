<?php 
include 'core/init.php';
logged_in_regirect();
include 'includes/overall/header.php'; 

if(empty($_POST) === false) {
    $required_fields = array('username','sifra','sifra_again','ime','prezime','mejl');
    foreach($_POST as $key=>$value) {
        if(empty($value) && in_array($key,$required_fields) === true) {
            $errors[] = 'All fields are required!';
            break 1;
        }
    }
    
    if(empty($errors) === true) {
        if(user_exists($_POST['username']) === true){
            $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken!';
        }
        if(preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'Your username must not contain any spaces.';
        }
        if(strlen($_POST['sifra']) < 6){
            $errors[] = 'Your password must be at least 6 characters.';
        }
        if($_POST['sifra'] !== $_POST['sifra_again']) {
            $errors[] = 'Your passwords do not match!';
        }
        if(filter_var($_POST['mejl'], FILTER_VALIDATE_EMAIL) === false ){
            $errors[] = 'A valid email is required!';
        }
        if(email_exists($_POST['mejl']) === true) {
            $errors[] = 'Sorry, the email \'' . $_POST['mejl'] . '\' is already in use!';
        }
    }
}

?>

<h1>Register</h1>

<?php
    if(isset($_GET['success']) && empty($_GET['success'])) {
        echo 'You\'ve been registered successfully!! :)';
    } else {
        if(empty($_POST) === false && empty($errors) === true) {
            $register_data = array(
                'korisnickoime' => $_POST['username'],
                'sifra' => $_POST['sifra'],
                'ime' => $_POST['ime'],
                'prezime' => $_POST['prezime'],
                'mejl' => $_POST['mejl']
            );

            register_user($register_data);
            header('Location: register.php?success');
            exit();
            
        } else if(empty($errors)===false) {
            echo output_errors($errors);
        }
?>

    <form action="" method="post">
        <ul>
            <li>
                Username:<br>
                <input type="text" name="username">
            </li>
            <li>
                Password:<br>
                <input type="password" name="sifra">
            </li>
            <li>
                Password again:<br>
                <input type="password" name="sifra_again">
            </li>
            <li>
                Ime:<br>
                <input type="text" name="ime">
            </li>
            <li>
                Prezime:<br>
                <input type="text" name="prezime">
            </li>
            <li>
                Email:<br>
                <input type="text" name="mejl">
            </li>
            <li>
                <input type="submit" value="Register">
            </li>
        </ul>
    </form>

<?php 
    }
    include 'includes/overall/footer.php';
?>