<?php
require '../model/db_utils/PDOCommunicator.php';
require '../model/repositories/CrudRepository.php';
require '../model/repositories/UserCrudRepository.php';
require '../model/entities/DBEntity.php';
require '../model/entities/User.php';
require '../model/utils/Visitor.php';
require '../model/utils/AssociativeImportVisitor.php';

session_start();
$isValidData = true;
$isUserExist = false;

$errorMessage = '';

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmPassword = trim($_POST["confirm_password"]);

$pattern = '/[^\s]*@[a-z0-9.-]*/i';
preg_match($pattern, $email, $matches, PREG_OFFSET_CAPTURE);

if (empty($email)) {
    $isValidData = false;
    $errorMessage .= "Please enter your email\n";
} else {
    if (sizeof($matches) !== 1) {
        $isValidData = false;
        $errorMessage .= "Please enter your email correctly\n";
    }
}
if (empty($password)) {
    $isValidData = false;
    $errorMessage .= "Please enter your password\n";
}
if (empty($confirmPassword)) {
    $isValidData = false;
    $errorMessage .= "Please enter confirm password\n";
}
if ($password !== $confirmPassword) {
    $isValidData = false;
    $errorMessage .= "Passwords are not equals\n";
}

if ($isValidData) {
    $PDOCommunicator = new PDOCommunicator();
    $userCrudRepository = new UserCrudRepository($PDOCommunicator);
    if (!$userCrudRepository->findByEmail($email)) {
        $userCrudRepository->save(new User($email, $password));
    } else $isUserExist = true;
}
if ($isUserExist) $_SESSION["errorMessage"] = 'The email address is already registered!';
if (!$isValidData) $_SESSION["errorMessage"] = $errorMessage;
if (!$isUserExist && $isValidData) $_SESSION["successMessage"] = 'Your registration was successful!';

header("location: ../view/register.php");