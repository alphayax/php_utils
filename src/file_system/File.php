<?php
namespace alphayax\utils\file_system;

/**
 * Class File
 * @package alphayax\utils\file_system
 */
class File {

    /** @var string */
    protected $file_afi;

    /**
     * File constructor.
     * @param $file_rfi
     */
    public function __construct( $file_rfi) {
        $this->file_afi = realpath( $file_rfi);
    }

    /**
     * @return string
     */
    public function getExtension(){
        $extension = strrchr( $this->getBaseName(), '.');
        if( $extension == false){
            return '';
        }
        $extension = substr( $extension, 1);
        return strtolower( $extension);
    }

    /**
     * @param $extension
     * @return bool
     */
    public function matchExtension( $extension){
        return strtolower( $extension) == $this->getExtension();
    }

    /**
     * @return string
     */
    public function getAbsolutePath() {
        return $this->file_afi;
    }

    /**
     * @return string
     */
    public function getBaseName(){
        return basename( $this->file_afi);
    }
    
}
