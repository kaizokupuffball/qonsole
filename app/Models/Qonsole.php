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
            'message' => 'Your IP adress is: ' . Request::ip(),
        ]);
    }

    /**
     * This example shows the use of arguments
     * Just a simple binary to hex command
     * This command is run by the command: hex "something you want to convert to hex"
     * Remember to double quotes for the string you want to convert!
     * All arguments must be enclodes in double quote
     *
     * @param String $string
     * @return void
     */
    static public function hex($string) 
    {
        return response()->json([
            'success' => true,
            'message' => bin2hex($string),
        ]);
    }

}