<?php
/**
 * Created by NOTEPAD (yes, notepad, i'm awesome).
 * User: Claudio A. Marrero
 * Date: 03/11/2014
 * Time: 09:26 PM
 */

require __DIR__ . '/../../vendor/autoload.php';
use Silex\WebTestCase;

class WebTest extends WebTestCase {

    public $client;
    public $app;

    public function createApplication() {
        $app_env = 'test';
        if(!$this->app){
            $this->app = require __DIR__ . '/../index.php';
        }
        return $this->app;
    }

    public function setUp() {
        parent::setUp();
        // Add your code here...
    }

    public function test_Media(){
        $this->client = $this->createClient();
        $crawler = $this->client->request('GET', '/media/846589506938951701_12522773');
        $response = $this->client->getResponse();

        $this->assertEquals(
            200,
            $response->getStatusCode(),
            'Endpoint gets ok'
        );
    }
}