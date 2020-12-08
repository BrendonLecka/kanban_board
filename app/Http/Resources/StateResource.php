<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'order' => $this->order,
            'board_id' => $this->board_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'issues' => IssueResource::collection($this->issues)
        ];
    }
}
