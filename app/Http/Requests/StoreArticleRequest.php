<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:255|unique:articles',
            'description' => 'required|min:10',
            'category' => "required|exists:categories,id",
            'photos' => 'required',
            'photos.*' => "mimes:png,jpg|file|max:512", // * is particular element
            'featured_image' => 'nullable|mimes:png,jpg|file|max:512'
        ];
    }
}
