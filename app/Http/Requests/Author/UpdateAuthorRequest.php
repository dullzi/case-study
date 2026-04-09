<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
        $authorId = $this->route('author');

        return [
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'sometimes|nullable|string',
            'birthdate' => 'sometimes|nullable|date',
            'email' => 'sometimes|nullable|email|unique:authors,email,' . $authorId,
        ];
    }
}
