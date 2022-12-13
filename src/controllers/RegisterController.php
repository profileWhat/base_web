<?php
require '../model/db_utils/PDOCommunicator.php';
require '../model/repositories/CrudRepository.php';
require '../model/repositories/UserCrudRepository.php';
require '../model/entities/DBEntity.php';
require '../model/entities/User.php';
require '../model/utils/Visitor.php';
require '../model/utils/AssociativeImportVisitor.php';

$isValidData = true;
$isUserExist = false;
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmPassword = trim($_POST["confirm_password"]);
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
if (empty($confirmPassword)) {
    $isValidData = false;
}
if ($password !== $confirmPassword) {
    $isValidData = false;
}

if ($isValidData) {
    $PDOCommunicator = new PDOCommunicator();
    $userCrudRepository = new UserCrudRepository($PDOCommunicator);
    if (!$userCrudRepository->findByEmail($email)) {
        $userCrudRepository->save(new User($email, $password));
    } else $isUserExist = true;
}