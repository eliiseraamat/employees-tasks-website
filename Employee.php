<?php

class Employee {

    public ?int $id;
    public string $firstName;
    public string $lastName;
    public string $picture;

    public function __construct(string $firstName, string $lastName, string $picture, ?int $id = null) {
        if ($id !== null) {
            $this->id = $id;
        }
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->picture = $picture;
    }
}
