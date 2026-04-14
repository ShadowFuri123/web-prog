<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Volont.php';

class VolontTest extends TestCase
{
    private $pdoMock;
    private $volont;

    /**
     * Шаг 5: Настройка окружения перед каждым тестом
     */
    protected function setUp(): void
    {
        parent::setUp(); // Вызываем родительский setUp для корректной работы PHPUnit

        // Создаем мок PDO и Statement
        $this->pdoMock = $this->createMock(PDO::class);
        $mockStmt = $this->createMock(PDOStatement::class);

        // Настраиваем поведение моков: prepare() возвращает mockStmt, execute() возвращает true
        $this->pdoMock->method('prepare')->willReturn($mockStmt);
        $mockStmt->method('execute')->willReturn(true);

        // Создаем объект Volont с моком PDO
        $this->volont = new Volont($this->pdoMock);
    }

    /**
     * Тест 1: Проверка добавления волонтера с корректными данными
     */
    public function testAdd()
    {
        // Вызываем метод add с 5 аргументами
        $result = $this->volont->add("Ivan", 20, "Экология", "Да", "Помощь");

        // Проверяем результат
        // Важно: в Volont.php должно быть return "Volont $username added";
        $this->assertEquals("Volont Ivan added", $result);
    }

    /**
     * Тест 2: Проверка обработки пустого имени
     */
    public function testAddEmptyName()
    {
        // Для проверки валидации БД не нужна, поэтому создаем отдельный объект с null
        $volontNoDb = new Volont(null);

        // ВАЖНО: Сохраняем результат в переменную $result, а не перезаписываем $volontNoDb
        $result = $volontNoDb->add("", 20, "IT", 3, "Consulting");

        // Проверяем, что вернулась ошибка
        $this->assertEquals("Name cannot be empty", $result);
    }
}