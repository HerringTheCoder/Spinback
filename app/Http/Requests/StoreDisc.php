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
            'condition'=>'alphanumeric|string',
            'photo_path'=>'photo_path',
            'offer_price'=>'digits_between:1,4',
            'sold'=>'boolean',
            'department_id'=>'exists|digits',
            'metadata_id' =>'exists|digits'
            ]
        ];
    }
}
