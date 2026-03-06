<?php
class Student {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($username, $date_birth, $direction, $experience, $type_help ) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO students (username, date_birth, direction, experience, type_help) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$username, $date_birth, $direction, $experience, $type_help]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM students");
        return $stmt->fetchAll();
    }

    public function update($id, $username) {
        $stmt = $this->pdo->prepare("UPDATE students SET username=? WHERE id=?");
        $stmt->execute([$username, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id=?");
        $stmt->execute([$id]);
    }
}
