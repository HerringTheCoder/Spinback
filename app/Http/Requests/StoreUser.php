<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreArtist extends FormRequest
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
            [
                'login'=>'required|alpha|max:30',
                'first_name' => 'min:3|max:20',
                'last_name' => 'min:3|max:20',
                'email' => 'unique|required|min:10|max:50'
            ]
        ];
    }
}
