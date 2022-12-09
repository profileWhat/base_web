<?php

abstract class CrudRepository
{
    protected PDOCommunicator $PDOCommunicator;
    private DBEntity $DBEntity;

    public function __construct(PDOCommunicator $PDOCommunicator, DBEntity $DBEntity)
    {
        $this->PDOCommunicator = $PDOCommunicator;
        $this->DBEntity = $DBEntity;
    }

    public function findById(int $id): false|array
    {
        $connection = $this->PDOCommunicator->getConnection();
        $tableName = $this->DBEntity->getTableName();
        $query = $connection->prepare("SELECT * FROM $tableName WHERE id=:id");
        $query->bindParam('id', $id, PDO::PARAM_INT);
        if ($query->execute()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function deleteById(int $id): bool
    {
        $connection = $this->PDOCommunicator->getConnection();
        $tableName = $this->DBEntity->getTableName();
        $query = $connection->prepare("DELETE * FROM $tableName WHERE id=:id");
        $query->bindParam('tableName', $tableName);
        $query->bindParam('id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function findAll(): false|array
    {
        $connection = $this->PDOCommunicator->getConnection();
        $tableName = $this->DBEntity->getTableName();
        $query = $connection->prepare("SELECT * FROM $tableName");
        if ($query->execute()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function deleteAll(): bool
    {
        $connection = $this->PDOCommunicator->getConnection();
        $tableName = $this->DBEntity->getTableName();
        $query = $connection->prepare("TRUNCATE TABLE $tableName");
        return $query->execute();
    }
}