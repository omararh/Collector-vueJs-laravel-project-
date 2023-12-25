<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use Exception;


class CommandController extends Controller
{
    /**
     * @OA\Post(
     *     path="/commands/store",
     *     tags={"command"},
     *     summary="Store a new command",
     *     description="Creates a new command and returns it.",
     *     operationId="storeCommand",
     *     security={{"bearerAuth":{}}, {"ApiKeyAuth" : {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass command details",
     *         @OA\JsonContent(
     *             required={"productIds","customerName","customerPhoneNumber","preparationTime","specificInstructions","totalPrice"},
     *             @OA\Property(property="productIds", type="string", format="json", example="['prod1', 'prod2']"),
     *             @OA\Property(property="customerName", type="string", example="John Doe"),
     *             @OA\Property(property="customerPhoneNumber", type="string", example="1234567890"),
     *             @OA\Property(property="preparationTime", type="integer", example=30),
     *             @OA\Property(property="specificInstructions", type="string", example="Leave at the door"),
     *             @OA\Property(property="totalPrice", type="integer", example=100),
     *             @OA\Property(property="active", type="boolean", example=true)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Command created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Command created successfully!"),
     *             @OA\Property(property="command", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error message")
     *         )
     *     )
     * )
     * store a new command
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
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
    public function getActives(): \Illuminate\Http\JsonResponse
    {
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
