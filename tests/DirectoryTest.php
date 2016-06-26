<?php

/**
 * Class RestTest
 */
class DirectoryTest extends PHPUnit_Framework_TestCase {

    public function testConstruct() {
        $directory =  __DIR__ . '/../src';
        $dir = new \alphayax\utils\file_system\Directory( $directory);
        $this->assertTrue( $dir->exists());
        $this->assertFileExists( $directory);
    }

}
