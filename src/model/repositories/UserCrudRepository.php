<?php


use JetBrains\PhpStorm\Pure;

class UserCrudRepository extends CrudRepository
{

    #[Pure] public function __construct(PDOCommunicator $PDOCommunicator)
    {
        parent::__construct($PDOCommunicator, User::withEmpty());
    }

    public function save(User $user): bool
    {
        $connection = $this->PDOCommunicator->getConnection();
        $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $email = $user->getEmail();
        $query = $connection->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");
        $query->bindParam("email", $email);
        $query->bindParam("password", $passwordHash);
        return $query->execute();
    }

    public function findByEmail(string $email): false|array
    {
        $connection = $this->PDOCommunicator->getConnection();
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email);
        if ($query->execute()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}