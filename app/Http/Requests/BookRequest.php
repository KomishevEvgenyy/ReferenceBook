<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'book_name' => 'required|min:3|max:50|unique:books,book_name',
            'description' => 'min:15',
            'image' => 'mimes:jpg,png|max:2048',
        ];

        if ($this->route()->named('books.update')) {
            $rules['book_name'] .= ',' . $this->route()->parameter('book')->id;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'book_name.required' => 'Поле "Название книги" обязательно для заполнение.',
            'book_name.min:3' => 'Поле "Название книги" должно иметь минимум min:3 символов.',
            'book_name.max:50' => 'Поле "Название книги" должно может быть максимум max:50 символов.',
            'book_name.unique' => 'Название такой книги уже существует',
            'description.min:15' => 'Поле "Название книги" должно иметь минимум min:15 символов.',
            'image.mimes:jpg,png' => 'Поле "Изображение" должно быть в формате mimes:jpg,png',
            'image.max:2048' => 'Поле "Изображение" должно быть не более 2 Мб',
        ];
    }
}
