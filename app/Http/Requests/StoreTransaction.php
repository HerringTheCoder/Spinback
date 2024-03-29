<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreTransaction extends FormRequest
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
                'department_id' => 'exists:departments,id',
                'disc_id' => 'exists:discs,id',
                'price' => 'required|digits_between:1,6',
                'operation_type' => 'required|string',
                'payment_type' => 'required|string'
        ];
    }
}
