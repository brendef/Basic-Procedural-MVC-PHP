<?php 
// Functions related to register_model.php
include($config['LIB_PATH'] . 'register_functions.php');

// Handles code when register form gets submitted
if (isset($_POST['register_submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(checkForEmptyInputsInSignup($username, $email, $password, $confirmPassword, $page) !== false){
        header("Location:?page=register&error=emptyinput");
        exit();
    }

    if(checkForValidUsername($username, $page) !== false){
        header("Location:?page=register&error=invalidUsername");
        exit();
    }

    if(checkForInvalidEmailAddress($email, $page) !== false){
        header("Location:?page=register&error=invalidEmailAddress");
        exit();
    }

    if(checkIfPasswordsMatch($password, $confirmPassword, $page) !== false){
        header("Location:?page=register&error=passwordsDoNotMatch");
        exit();
    }

    if(checkIfUsernameExists($connection, $username, $page) !== false){
        header("Location:?page=register&error=usernameTaken");
        exit();
    }

    if(checkIfEmailAddressExists($connection, $email, $page) !== false){
        header("Location:?page=register&error=emailTaken");
        exit();
    }
    
    createUser($connection, $username, $email, $password, $page);
    
} 