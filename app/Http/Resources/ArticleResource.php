<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_rus' => $this->title_rus,
            'image' => $this->image,
            'category' => new CategoryResource($this->category),
            'type' => new TypeResource($this->type),
        ];
    }
}
