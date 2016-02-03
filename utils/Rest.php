<?php
namespace alphayax\utils;

/**
 * Class Rest
 * @package alphayax\utils
 * @author <alphayax@gmail.com>
 */
class Rest {

    /** @var resource */
    protected $_curl_handler;

    /** @var array */
    protected $_curl_response;

    /** @var bool Indicate if the return is in JSON format */
    protected $_isJson = true;

    /** @var bool */
    protected $_returnAsArray = true;

    /**
     * Rest constructor.
     * @param $_url
     * @param bool $isJson
     * @param bool $returnAsArray
     */
    public function __construct( $_url, $isJson = true, $returnAsArray = true){
        $this->_curl_handler  = curl_init( $_url);
        $this->_isJson        = $isJson;
        $this->_returnAsArray = $returnAsArray;

    }

    /**
     * Perform a GET request
     * @param $curl_post_data
     */
    public function GET( $curl_post_data = null){
        curl_setopt( $this->_curl_handler, CURLOPT_RETURNTRANSFER, true);
        $this->addPostFields( $curl_post_data);
        $this->exec();
    }

    /**
     * Perform a POST request
     * @param $curl_post_data
     */
    public function POST( $curl_post_data = null){
        curl_setopt( $this->_curl_handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $this->_curl_handler, CURLOPT_POST, true);
        $this->addPostFields( $curl_post_data);
        $this->exec();
    }

    /**
     * Perform a PUT request
     * @param $curl_post_data
     */
    public function PUT( $curl_post_data = null){
        curl_setopt( $this->_curl_handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $this->_curl_handler, CURLOPT_CUSTOMREQUEST, 'PUT');
        $this->addPostFields( $curl_post_data);
        $this->exec();
    }

    /**
     * Perform a DELETE request
     * @param $curl_post_data
     */
    public function DELETE( $curl_post_data = null){
        curl_setopt( $this->_curl_handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $this->_curl_handler, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->addPostFields( $curl_post_data);
        $this->exec();
    }

    /**
     * Add the Post Fields (if not null)
     * @param $curl_post_data
     */
    protected function addPostFields( $curl_post_data){
        if( ! is_null( $curl_post_data)){
            curl_setopt( $this->_curl_handler, CURLOPT_POSTFIELDS, json_encode( $curl_post_data));
        }
    }

    /**
     * Execute the HTTP request
     * @throws \Exception
     */
    private function exec(){
        $this->_curl_response = curl_exec( $this->_curl_handler);
        if( $this->_curl_response === false) {
            $info = curl_getinfo( $this->_curl_handler);
            curl_close( $this->_curl_handler);
            throw new \Exception( 'Error occurred during curl exec. Additional info: ' . var_export( $info));
        }
        curl_close( $this->_curl_handler);

        // Decode JSON if we need to
        if( $this->_isJson){
            $this->_curl_response = json_decode( $this->_curl_response, $this->_returnAsArray);
        }
        $this->_curl_response;
    }

    /**
     * @return mixed
     */
    public function getCurlResponse(){
        return $this->_curl_response;
    }

}
