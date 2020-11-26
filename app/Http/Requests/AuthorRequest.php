<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'author_surname' => 'required|min:3|max:30',
            'author_name' => 'required|min:3|max:30',
            'author_patronymic' => 'max:30',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'author_surname.required' => 'Поле "Фамилия автора" обязательно для заполнение.',
            'author_surname.min:3' => 'Поле "Фамилия автора" должно иметь минимум min:3 символов.',
            'author_surname.max:30' => 'Поле "Фамилия автора" может быть максимум max:50 символов.',
            'author_name.required' => 'Поле "Имя автора" обязательно для заполнение.',
            'author_name.min:3' => 'Поле "Имя автора" должно иметь минимум min:3 символов.',
            'author_name.max:30' => 'Поле "Имя автора" может быть максимум max:50 символов.',
            'author_patronymic.max:30' => 'Поле "Отчество автора" может быть максимум max:50 символов.',
        ];
    }
}
