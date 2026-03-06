<?php
class Student {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($name, $date_birth, $direction, $experience, $Kind_help ) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO students (name, date_birth, direction, experience, Kind_help) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $date_birth, $direction, $experience, $Kind_help]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM students");
        return $stmt->fetchAll();
    }

    public function update($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE students SET name=? WHERE id=?");
        $stmt->execute([$name, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id=?");
        $stmt->execute([$id]);
    }
}
