<?php

require '../src/model/db_utils/PDOCommunicator.php';
require '../src/model/repositories/CrudRepository.php';
require '../src/model/repositories/UserCrudRepository.php';
require '../src/model/entities/DBEntity.php';
require '../src/model/entities/User.php';
require '../src/model/utils/Visitor.php';
require '../src/model/utils/AssociativeImportVisitor.php';

$PDOCommunicator = new PDOCommunicator();
$userCrudRepository = new UserCrudRepository($PDOCommunicator);

$userGet = User::withEmpty();

/** save test 1 */
$user = new User('test@mail.ru', 'test');
$userCrudRepository->save($user);

/** test 2 findByEmail*/
$array = $userCrudRepository->findByEmail('test@mail.ru');
$userGet->accept(new AssociativeImportVisitor($array));
if ($user->getEmail() !== $userGet->getEmail() && $user->getPassword() !== $userGet->getPassword())
    throw new RuntimeException("Test2 uncompleted");

/** test 3 getById */

$array = $userCrudRepository->findById(1);
$userGet->accept(new AssociativeImportVisitor($array));
if ($user->getEmail() !== $userGet->getEmail() && $user->getPassword() !== $userGet->getPassword())
    throw new RuntimeException("Test3 uncompleted");

/** test4 findAll */

$array = $userCrudRepository->findAll();
print_r($array);

/** test5 deleteAll */

$array = $userCrudRepository->deleteAll();


