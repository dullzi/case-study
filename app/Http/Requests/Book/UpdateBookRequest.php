<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookId = $this->route('book');

        return [
            'title' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|nullable|string|unique:books,isbn,' . $bookId,
            'published_at' => 'sometimes|nullable|date',
            'description' => 'sometimes|nullable|string',
            'author_id' => 'sometimes|required|exists:authors,id',
            'publisher_id' => 'sometimes|required|exists:publishers,id',
        ];
    }
}
