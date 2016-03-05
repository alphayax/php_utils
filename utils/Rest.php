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

    /** @var array of HTTP Headers */
    protected $http_headers = [];

    /** @var bool Indicate if the return is in JSON format */
    protected $_isJson = true;

    /** @var bool Send post data in Json or not */
    protected $_sendInJson = true;

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
            $data = $this->_sendInJson ? json_encode( $curl_post_data) : $curl_post_data;
            curl_setopt( $this->_curl_handler, CURLOPT_POSTFIELDS, $data);
        }
    }

    /**
     * Define the content type as "application/x-www-form-urlencoded"
     */
    public function setContentType_XFormURLEncoded(){
        $this->http_headers[ 'Content-Type'] = 'application/x-www-form-urlencoded';
        $this->_sendInJson = false;
    }

    /**
     * Define HTTP Headers in the REST call
     */
    protected function processHeaders(){
        if( empty( $this->http_headers)){
            return;
        }
        $HTTP_headers = [];
        foreach( $this->http_headers as $http_header_name => $http_header_value){
            $HTTP_headers[] = "$http_header_name: $http_header_value";
        }
        curl_setopt( $this->_curl_handler, CURLOPT_HTTPHEADER, $HTTP_headers);
    }

    /**
     * Execute the HTTP request
     * @throws \Exception
     */
    private function exec(){
        $this->processHeaders();
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
