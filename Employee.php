<?php

class Employee {

    public int $id;
    public string $firstName;
    public string $lastName;
    public string $picture;

    public function __construct(int $id, string $firstName, string $lastName, string $picture) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->picture = $picture;
    }
}
