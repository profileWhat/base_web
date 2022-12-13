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
$isCorrectPassword = true;
$isUserExist = true;

$errorMessage = '';

$email = trim($_POST['email']);
$password = trim($_POST['password']);

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

if ($isValidData) {
    $PDOCommunicator = new PDOCommunicator();
    $userCrudRepository = new UserCrudRepository($PDOCommunicator);
    $user = User::withEmpty();
    $userAssociativeArray = $userCrudRepository->findByEmail($email);
    if ($userAssociativeArray !== false) {
        $user->accept(new AssociativeImportVisitor($userAssociativeArray));
        if (password_verify($password, $user->getPassword())) {
            $_SESSION["userid"] = $user->getId();
            $_SESSION["userEmail"] = $user->getEmail();
        } else $isCorrectPassword = false;
    } else $isUserExist = false;
}
if (!$isValidData) {
    $_SESSION["errorMessage"] = $errorMessage;
    header("location: ../view/login.php");
}
if (!$isCorrectPassword) {
    $_SESSION["errorMessage"] = 'Incorrect password';
    header("location: ../view/login.php");
}
if (!$isUserExist) {
    $_SESSION["errorMessage"] = 'User with that email is not exist';
    header("location: ../view/login.php");
}
if ($isCorrectPassword && $isValidData && $isUserExist) header("location: ../view/main.php");