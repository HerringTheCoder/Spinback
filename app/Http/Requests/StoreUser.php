<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|alpha|max:30',
            'password' => 'required|min:8',
            'first_name' => 'min:3|max:20',
            'last_name' => 'min:3|max:20',
            'email' => 'unique:users|required|email',
        ];
    }
}
