<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QonsoleController extends Controller
{
    /**
     * Run a command
     *
     * @param String $command
     * @return void
     */
    public function run(Request $request) 
    {

        // Split the command up into pieces (command and arguments)
        // $tmp[0] is the command
        // Everything above the first index is a argument
        $tmp = array_filter(explode('"', $request->command), function ($elem) {
            return is_string($elem) && '' !== trim($elem);
        });

        // Our model containing all the commands we can run
        $model = 'App\Models\Qonsole';

        // This is the command we want to run
        $command = strtolower(trim($tmp[0]));

        // All the arguments for the commands
        $args = [];
        $i = 0;
        if (count($tmp) >= 1) {
            foreach ($tmp as $arg) {
                if ($i > 0) {
                    $args[] = trim($arg);
                } 
                $i++;
            }
        }

        // Check for command existence in the model
        if (method_exists($model, $command)) {

            // Run the command with the arguments
            return call_user_func_array([$model, $command], $args);

        } else {

            // Command not found
            return response()->json([
                'success' => false,
                'message' => 'Command not found:',
                'result' => $command
            ]);

        }
    }
}
