<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use Exception;


class CommandController extends Controller
{
    /*
    * store a new command
    */
    public function store(Request $request) {
        try {
            // Validate the request data
            $request->validate([
                'productIds' => 'required|json',
                'customerName' => 'required|string',
                'preparationTime' => 'required|integer',
                'active' => 'boolean'
            ]);

            // Create a new Command
            $command = new Command([
                'productIds' => $request->get('productIds'),
                'customerName' => $request->get('customerName'),
                'preparationTime' => $request->get('preparationTime'),
                'active' => $request->get('active', true), // Default value is false
            ]);

            // Save the Command
            $command->save();

            // Return a response
            return response()->json([
                'message' => 'Command created successfully!',
                'command' => $command
            ], 201);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
    * get All the active commands
    */
    public function getActives() {
        try {
            // Retrieve all active Commands
            $activeCommands = Command::where('active', true)->get();

            // Return a response
            return response()->json([
                'activeCommands' => $activeCommands
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
    * get all the commands
    */
    public function get() {
        try {
            return response()->json(
                Command::All()
            );

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
    * set the column active to the opposite value
    */
    public function changeStatus($id) {
        try {
            // Retrieve the Command
            $command = Command::findOrFail($id);

            // Change the status
            $command->active = !$command->active;

            // Save the changes
            $command->save();

            // Return a response
            return response()->json([
                'message' => 'Command status updated successfully!',
                'command' => $command
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
