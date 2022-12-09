<?php


use JetBrains\PhpStorm\Pure;

class User implements DBEntity
{
    private int $id;
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function accept(Visitor $visitor) {
        return $visitor->visitUser($this);
    }

    /**
     * @return User
     */
    #[Pure] public static function withEmpty(): User
    {
        return new self('', '');
    }

    public function getTableName(): string
    {
        return 'users';
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return "id=$this->id, email=$this->email, password=$this->password";
    }
}