<?php

namespace App\Http\Controllers\API\V1_2;

use App\Http\Controllers\Controller;
use App\Http\Resources\CellResource;
use App\Models\Cell;
use Illuminate\Http\Request;

class CellController extends Controller
{
    public function show(Request $request, $code)
    {
        $cell = Cell::where("code", $code)->first();
        if (is_object($cell)) {
            return response()->json(
                new CellResource($cell)
            );
        } else {
            return response()->json([
                'error' => "Cell not found",
            ], 404);
        }
    }

    public function unverified(Request $request)
    {
        $cells = Cell::where("verified",0)->get();
        return response()->json(CellResource::collection($cells));
    }
}
