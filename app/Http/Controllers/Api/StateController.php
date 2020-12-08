<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest\StoreState;
use App\Http\Requests\StateRequest\UpdateState;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class StateController extends Controller
{
    public function index(): JsonResponse
    {
        $state = State::all();
        if (request()->exists('issues')) {
            $state = StateResource::collection(State::all());
        }

        return response()->json(['data' => $state]);
    }

    public function store(StoreState $request): JsonResponse
    {
        $state = State::create($request->validated());

        return response()->json(['state' => $state], Response::HTTP_CREATED);
    }

    public function show(State $state): JsonResponse
    {
        return response()->json(['state' => StateResource::collection(State::find($state))]);
    }

    public function update(UpdateState $request, State $state): JsonResponse
    {
        $state->update($request->validated());

        return response()->json($state, Response::HTTP_OK);
    }

    public function destroy(State $state): JsonResponse
    {
        $state->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
