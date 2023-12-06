<?php

use Tabbakka\LightOrm\Entities\IEntityInterface;

class User implements IEntityInterface
{
    protected int $id;

    protected string $email;

    protected string $password;

    protected string $first_name;

    protected string $last_name;

    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    #[\Override] public function toDatabase(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        ];
    }

    /**
     * @inheritDoc
     */
    #[\Override] public static function toEntity(array $data): User
    {
        $user = new User();
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];

        return $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }
}