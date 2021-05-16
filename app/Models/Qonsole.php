<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

/**
 * This is the model containing all the commands that can be run
 * All methods are considered commands
 * All methods must be static!
 */
class Qonsole extends Model
{
    /**
     * A simple "whats my ip address" command
     * The method name is the command: ip
     * 
     * @return void
     */
    static public function ip()
    {
        return response()->json([
            'success' => true,
            'message' => 'Your IP adress is:',
            'result' =>  Request::ip(),
        ]);
    }

    /**
     * This example shows the use of arguments
     * Just a simple base64 to string command
     * This command is run by the command: base64decode "base64 string here"
     * Remember to double quotes for the string you want to convert!
     * All arguments must be enclodes in double quote
     *
     * @param String $string
     * @return void
     */
    static public function base64decode($base64) 
    {
        return response()->json([
            'success' => true,
            'message' => 'Base64 decoded string:',
            'result' => base64_decode($base64)
        ]);
    }

    /**
     * This example shows the use of arguments
     * Just a simple string to base64 command
     * This command is run by the command: base64encode "string here"
     * Remember to double quotes for the string you want to convert!
     * All arguments must be enclodes in double quote
     *
     * @param String $string
     * @return void
     */
    static public function base64encode($string) 
    {
        return response()->json([
            'success' => true,
            'message' => 'Base64 encoded string:',
            'result' => base64_encode($string)
        ]);
    }
}