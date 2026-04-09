<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Book Request",
 *      description="Store Book request body data",
 *      type="object",
 *      required={"title", "author_id", "publisher_id"}
 * )
 */
class StoreBookRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the new book",
     *      example="The Great Gatsby"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="isbn",
     *      description="ISBN of the new book",
     *      example="978-3-16-148410-0"
     * )
     *
     * @var string
     */
    public $isbn;

    /**
     * @OA\Property(
     *      title="author_id",
     *      description="ID of the author",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $author_id;

    /**
     * @OA\Property(
     *      title="publisher_id",
     *      description="ID of the publisher",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $publisher_id;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
        ];
    }
}
