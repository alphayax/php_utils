<?php

/**
 * Class RestTest
 */
class RestTest extends PHPUnit_Framework_TestCase {



    public function testConstruct() {
        $rest = new \alphayax\utils\Rest( 'https://api.github.com/users/alphayax/repos');
        $this->assertAttributeEquals( true, '_isJson', $rest);
        $this->assertAttributeEquals( true, '_returnAsArray', $rest);
    //    $rest->addHeader( 'User-Agent', 'alphayax-php_utils');
//        $rest->GET();

  //      $rest->getCurlResponse();
    }

    public function testHeader() {
        $rest = new \alphayax\utils\Rest( 'https://api.github.com/users/alphayax/repos');
        $this->assertAttributeEmpty( 'http_headers', $rest);
        $rest->addHeader( 'User-Agent', 'alphayax-php_utils');
        $this->assertAttributeNotEmpty( 'http_headers', $rest);
        $this->assertAttributeEquals( ['User-Agent'=> 'alphayax-php_utils'], 'http_headers', $rest);
    }


    public function testGET() {
        $rest = new \alphayax\utils\Rest( 'http://jsonplaceholder.typicode.com/posts/1');
        $rest->addHeader( 'User-Agent', 'alphayax-php_utils');
        $this->assertAttributeEmpty( '_curl_response', $rest);
        $rest->GET();
        $this->assertAttributeNotEmpty( '_curl_response', $rest);
    }

    


}
