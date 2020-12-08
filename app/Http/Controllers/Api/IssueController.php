<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueRequest\StoreIssue;
use App\Http\Requests\IssueRequest\UpdateIssue;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IssueController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => IssueResource::collection(Issue::all())]);
    }

    public function store(StoreIssue $request): JsonResponse
    {
        $issue = Issue::create($request->validated());

        return response()->json(['issue' => $issue], Response::HTTP_CREATED);
    }

    public function show(Issue $issue): JsonResponse
    {
        return response()->json(['issue' => $issue]);
    }

    public function update(UpdateIssue $request, Issue $issue): JsonResponse
    {
        $issue->update($request->validated());

        return response()->json(['issue' => $issue], Response::HTTP_OK);
    }

    public function destroy(Issue $issue): JsonResponse
    {
        $issue->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
