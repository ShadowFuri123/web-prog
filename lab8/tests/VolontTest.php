<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Volont.php';

class VolontTest extends TestCase
{
    public function testAdd()
    {
        // 1. Создаем мок PDO и Statement, чтобы не нужна была реальная БД
        $mockPdo = $this->createMock(PDO::class);
        $mockStmt = $this->createMock(PDOStatement::class);

        // 2. Настраиваем поведение моков
        $mockPdo->method('prepare')->willReturn($mockStmt);
        $mockStmt->method('execute')->willReturn(true);

        // 3. Передаем мок в конструктор (исправляем ошибку ArgumentCountError)
        $volont = new Volont($mockPdo);

        // 4. Вызываем метод с 5 аргументами
        $result = $volont->add("Ivan", 20, "Экология", "Да", "Помощь");

        // 5. Проверяем результат (теперь совпадает с вашим обновленным Volont.php)
        $this->assertEquals("Volont Ivan added", $result);
    }

    public function testAddEmptyName()
    {
        // Для проверки пустого имени БД не нужна, передаем null
        $volont = new Volont(null);

        // ВАЖНО: Сохраняем результат в переменную $result, а не перезаписываем $volont
        $result = $volont->add("", 20, "IT", 3, "Consulting");

        // Проверяем результат
        $this->assertEquals("Name cannot be empty", $result);
    }
}