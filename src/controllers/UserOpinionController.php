<?php
require '../model/utils/Serializer.php';
require '../model/utils/CheckboxSerializer.php';
require '../model/utils/DDListSerializer.php';
require '../model/utils/RadioSerializer.php';
require '../model/entities/DBEntity.php';
require '../model/entities/UserOpinion.php';
require '../model/db_utils/PDOCommunicator.php';
require '../model/repositories/CrudRepository.php';
require '../model/repositories/UserOpinionCrudRepository.php';

session_start();

$userId = $_SESSION["userId"];

$text = $_POST['text'];
$areaText = $_POST['areaText'];
$ddList = (new DDListSerializer($_POST['ddList']))->serialize();
$radio = (new RadioSerializer($_POST['radioOpinion']))->serialize();
$checkbox = (new CheckboxSerializer($_POST['checkboxOpinion']))->serialize();

$userOpinion = new UserOpinion($userId, $text, $areaText, $ddList, $radio, $checkbox);
$userOpinionRepository = new UserOpinionCrudRepository(new PDOCommunicator());

if ($userOpinionRepository->save($userOpinion)) {
    $_SESSION["successMessage"] = "Your opinion successfully sent";
} else $_SESSION["errorMessage"] = "Your opinion didn't send";

header("location: ../view/main.php");
