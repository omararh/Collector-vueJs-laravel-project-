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
                'customerPhoneNumber' => 'required|string',
                'preparationTime' => 'required|integer',
                'specificInstructions' => 'required|string',
                'totalPrice' => 'required|integer',
                'active' => 'boolean'
            ]);

            // Create a new Command
            $command = new Command([
                'productIds' => $request->get('productIds'),
                'customerName' => $request->get('customerName'),
                'customerPhoneNumber' => $request->get('customerPhoneNumber'),
                'preparationTime' => $request->get('preparationTime'),
                'specificInstructions' => $request->get('specificInstructions'),
                'totalPrice' => $request->get('totalPrice'),
                'active' => $request->get('active', true), // Default value is true
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
            $activeCommands = Command::where('active', true)->get();

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
            $command->active = !$command->active;
            $command->save();

            return response()->json([
                'message' => 'Command status updated successfully!',
                'command' => $command
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
    * get commandes by user phone number
    */
    public function getCommandsByUser($phoneNumber){
        try {
            $commands = Command::where('customerPhoneNumber', $phoneNumber)->get();
            return $commands;
        }catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getCommandByDate(Request $request) {
        try {
            $commands = Command::whereDate('created_at', '=', $request->get('date'))->get();
            return response()->json($commands, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
