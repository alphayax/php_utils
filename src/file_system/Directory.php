<?php
namespace alphayax\utils\file_system;

/**
 * Class Directory
 * @package alphayax\utils\file_system
 */
class Directory {

    /** @var string */
    protected $directory_afi;

    /** @var array */
    protected $content = [];

    /**
     * Directory constructor.
     * @param $directoryPath
     */
    public function __construct( $directoryPath) {
        $this->directory_afi = realpath( $directoryPath);
        if( $this->exists()){
            $this->scan();
        }
    }

    /**
     * @return array
     */
    public function scan(){
        $files = scandir( $this->directory_afi);
        foreach ( $files as $file_rfi){
            $file_afi = $this->directory_afi . DIRECTORY_SEPARATOR . $file_rfi;

            /// Ignore pointers
            if( $file_rfi == '.' || $file_rfi == '..'){
                continue;
            }

            /// Sub Directories
            if( is_dir( $file_afi)){
                $this->content[] = new Directory( $file_afi);
                continue;
            }

            /// Files
            if( is_file( $file_afi)){
                $this->content[] = new File( $file_afi);
            }
        }
        return $files;
    }

    /**
     * Return TRUE if the repertory exists. FALSE otherwise
     * @return bool
     */
    public function exists(){
        return is_dir( $this->directory_afi);
    }

    /**
     * Create the directory
     * @param int $mode
     * @return bool
     */
    public function create( $mode = 0777){
        return @mkdir( $this->directory_afi, $mode, true);
    }

    /**
     * Get the directory content (files & sub directories)
     * @return array
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * @param string $extension
     * @param bool   $includeSubDir
     * @return File[]
     */
    public function getFilesByExtension( $extension, $includeSubDir = false){
        $foundedFiles = [];
        foreach( $this->content as $item){

            if( $includeSubDir && $item instanceof Directory){
                $foundedFiles = array_merge( $foundedFiles, $item->getFilesByExtension( $extension, true));
            }
            elseif( $item instanceof File){
                if( $item->matchExtension( $extension)){
                    $foundedFiles[] = $item->getAbsolutePath();
                }

            }
        }
        return $foundedFiles;
    }

}
