<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublisherRequest extends FormRequest
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
        $publisherId = $this->route('publisher');

        return [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email|unique:publishers,email,' . $publisherId,
            'phone' => 'sometimes|nullable|string',
        ];
    }
}
