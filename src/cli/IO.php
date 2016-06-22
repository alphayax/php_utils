<?php
namespace alphayax\utils\cli;

/**
 * Class IO
 * @package alphayax\utils\cli
 * @author <alphayax@gmail.com>
 */
class IO {

    /// Default Streams
    const STREAM_STDOUT = 'php://stdout';
    const STREAM_STDERR = 'php://stderr';

    /// Default Colors
    const COLOR_REGULAR = "%s";
    const COLOR_CYAN    = "\033[01;36m%s\033[00m";
    const COLOR_MAGENTA = "\033[01;35m%s\033[00m";
    const COLOR_BLUE    = "\033[01;34m%s\033[00m";
    const COLOR_YELLOW  = "\033[01;33m%s\033[00m";
    const COLOR_GREEN   = "\033[01;32m%s\033[00m";
    const COLOR_RED     = "\033[01;31m%s\033[00m";

    /**
     * Write message on stdout
     * @param string $message    Message
     * @param int    $indentNb   Indentation ( = 0)
     * @param bool   $endOfLine  Add a Carriage return ( = true)
     * @param string $color      One of constant Cli::COLOR_*
     */
    public static function stdout( $message, $indentNb = 0, $endOfLine = true, $color = self::COLOR_REGULAR){
        self::_stream_write( self::STREAM_STDOUT, $message, $indentNb, $endOfLine, $color);
    }

    /**
     * Write message on stderr
     * @param string $message   Message
     * @param int    $indentNb  Indentation ( = 0)
     * @param bool   $endOfLine Add a Carriage return ( = true)
     * @param string $color     One of constant Cli::COLOR_*
     */
    public static function stderr( $message, $indentNb = 0, $endOfLine = true, $color = self::COLOR_REGULAR){
        self::_stream_write( self::STREAM_STDERR, $message, $indentNb, $endOfLine, $color);
    }

    /**
     * Get a string given to stdin
     * @return string
     */
    public static function stdin(){
        return trim( fgets( STDIN));
    }

    /**
     * Write to given stream
     * @param string $stream    Filename or stream (php://*)
     * @param string $message   Message
     * @param int    $indentNb  Indentation ( = 0)
     * @param bool   $endOfLine Add a Carriage return ( = true)
     * @param string $color     One of constant Cli::COLOR_*
     */
    private static function _stream_write( $stream, $message, $indentNb, $endOfLine, $color){
        $indent = $indentNb   ? str_repeat( '  ', $indentNb) : '';
        $eol    = $endOfLine  ? PHP_EOL                      : '';
        $text   = sprintf( $color, $indent . $message . $eol);
        file_put_contents( $stream, $text);
    }

}
