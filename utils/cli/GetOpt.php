<?php
namespace alphayax\utils\cli;


/**
 * Class GetOpt
 * @package alphayax\utils
 */
class GetOpt {

    /** @var array Required options */
    protected $requiredOpt = [];

    /** @var array List of short options */
    private $shortOpt = [];

    /** @var array List of long options */
    private $longOpt = [];

    /** @var array Args passed to the script */
    private $opt_x = [];


    /**
     * @param $optName
     * @param $optDesc
     * @param bool|false $hasValue
     * @param bool|false $isRequired
     */
    public function addLongOpt( $optName, $optDesc, $hasValue = false, $isRequired = false){
        $hasValueFlag = $hasValue ? ':' : '';
        $this->longOpt[ $optName . $hasValueFlag] = $optDesc;
        if( $isRequired){
            $this->requiredOpt[] = $optName;
        }
    }

    /**
     * @param $optLetter
     * @param $optDesc
     * @param bool|false $hasValue
     * @param bool|false $isRequired
     * @throws \Exception
     */
    public function addShortOpt( $optLetter, $optDesc, $hasValue = false, $isRequired = false){
        if( strlen( $optLetter) > 1){
            throw new \Exception( 'Invalid option. A short opt must be a letter [a-zA-Z0-9]');
        }
        $hasValueFlag = $hasValue ? ':' : '';
        $this->shortOpt[ $optLetter . $hasValueFlag] = $optDesc;
        if( $isRequired){
            $this->requiredOpt[] = $optLetter;
        }
    }

    /**
     * Parse the args given to the script
     */
    public function parse(){
        $shortOptz = implode( '', array_keys( $this->shortOpt));
        $longOpt = array_keys( $this->longOpt);
        $this->opt_x = getopt( $shortOptz, $longOpt);

        $givenOpts = array_keys( $this->opt_x);
        $missingOpt = array_diff( $this->requiredOpt, $givenOpts);

        if( ! empty( $missingOpt)){
            throw new \Exception('Required fields missing : '. var_export( $missingOpt, true));
        }
    }

    /**
     * Return the value of a specific option
     * @param $optionName
     * @return mixed
     */
    public function getOptionValue( $optionName){
        return @$this->opt_x[ $optionName];
    }

    /**
     * Return true if the option have been specified in script args
     * @param $optionName
     * @return bool
     */
    public function hasOption( $optionName){
        return array_key_exists( $optionName, $this->opt_x);
    }

}