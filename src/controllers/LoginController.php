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
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$pattern = '/[^\s]*@[a-z0-9.-]*/i';
preg_match($pattern, $email, $matches, PREG_OFFSET_CAPTURE);
if (empty($email)) {
    $isValidData = false;
} else {
    if (sizeof($matches) !== 1) {
        $isValidData = false;
    }
}
if (empty($password)) {
    $isValidData = false;
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

if ($isCorrectPassword && $isValidData && $isUserExist) header("location: ../view/main.php");