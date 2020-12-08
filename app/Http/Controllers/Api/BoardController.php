<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardRequest\StoreBoard;
use App\Http\Requests\BoardRequest\UpdateBoard;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BoardController extends Controller
{
    public function index(): JsonResponse
    {
        $boards = Board::all();
        if (request()->exists('states')) {
            $boards = BoardResource::collection(Board::all());
        }

        return response()->json(['data' => $boards]);
    }

    public function store(StoreBoard $request): JsonResponse
    {
        $board = Board::create($request->validated());

        return response()->json(['board' => $board], Response::HTTP_CREATED);
    }

    public function show(Board $board): JsonResponse
    {
        return response()->json(['board' => BoardResource::collection(Board::find($board))]);
    }

    public function update(UpdateBoard $request, Board $board): JsonResponse
    {
        $board->update($request->validated());

        return response()->json($board, Response::HTTP_OK);
    }

    public function destroy(Board $board): JsonResponse
    {
        $board->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
