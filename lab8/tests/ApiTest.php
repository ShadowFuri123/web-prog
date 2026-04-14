<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class ApiTest extends TestCase
{
    public function testRequest()
    {
        // ВАЖНО: Замените порт 8080 на тот, который указан в вашем docker-compose.yml
        // Если вы не используете Docker, а запускаете локальный сервер PHP, используйте http://localhost:8000
        $baseUrl = 'http://localhost:8080';

        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout'  => 2.0,
        ]);

        try {
            // Выполняем GET-запрос к вашему приложению
            // Убедитесь, что файл index.php лежит в папке www (как на скриншоте структуры)
            // Поэтому путь может быть /www/index.php или просто /index.php, зависит от настроек веб-сервера в Docker
            $response = $client->get('/www/index.php');

            // Проверяем статус код 200
            $this->assertEquals(200, $response->getStatusCode());

            // Опционально: проверяем, что ответ не пустой
            $body = $response->getBody()->getContents();
            $this->assertNotEmpty($body);

        } catch (ConnectException $e) {
            // Если сервер не запущен, тест упадет с понятным сообщением
            $this->fail("Не удалось подключиться к серверу по адресу {$baseUrl}. Убедитесь, что Docker запущен и контейнеры работают. Ошибка: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->fail("Ошибка при выполнении запроса: " . $e->getMessage());
        }
    }
}