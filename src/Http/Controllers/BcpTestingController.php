<?php

namespace Shafiqruslan\BcpTesting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class BcpTestingController extends Controller
{
    public function index()
    {
        try {
            $connectionName = config('database.connections.siza') !== null ? 'siza' : 'oracle';

            $result = DB::connection($connectionName)->select('SELECT 1 as test FROM DUAL');

            // Check if connection was successful
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Oracle database connection successful',
                    'data' => $result
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Oracle connection failed - no result returned'
            ], 500);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Oracle database connection failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
