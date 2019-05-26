<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUser extends FormRequest
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
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
                'min:10|max:50',
                        ],
        'first_name' => 'min:3|max:25|alpha',
        'last_name' => 'required|min:3|alpha|max:30',
        ];

    }
}
