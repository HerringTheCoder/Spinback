<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisc extends FormRequest
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
                'condition' => 'string|nullable',
                'offer_price' => 'integer|required',
                'department_id' => 'exists|integer|required',
                'album_id' => 'exists|uuid|required'
            ]
        ];
    }
}
