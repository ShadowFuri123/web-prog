<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;



class ApiTest extends TestCase
{
   public function testRequest()
   {
       $client = new Client([
           'base_uri' => 'http://nginx'
       ]);

       $response = $client->get('/index.php');

       $this->assertEquals(200, $response->getStatusCode());
   }
}
