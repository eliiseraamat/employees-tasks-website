<?php

class Task {

    public ?int $id;
    public string $description;
    public int $estimate;
    public int $employee_id;
    public string $status;

    public function __construct(string $description, int $estimate, int $employee_id, string $status, ?int $id = null) {
        if ($id !== null) {
            $this->id = $id;
        }
        $this->description = $description;
        $this->estimate = $estimate;
        $this->employee_id = $employee_id;
        $this->status = $status;
    }
}
