<?php

class Task {

    public int $id;
    public string $description;
    public string $estimate;
    public string $employee_id;
    public bool $isCompleted;
    public string $status;

    public function __construct(int $id, string $description, string $estimate, string $employee_id, bool $isCompleted, string $status) {
        $this->id = $id;
        $this->description = $description;
        $this->estimate = $estimate;
        $this->employee_id = $employee_id;
        $this->isCompleted = $isCompleted;
        $this->status = $status;
    }
}
