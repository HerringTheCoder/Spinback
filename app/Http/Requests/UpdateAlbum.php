<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlbum extends FormRequest
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
                'title' => 'min:3|max:30',
                'artist_id' => 'exists',
                'genre' => 'string|min:3|max:15',
                'country' => 'string|max:20|min:3',
                'release_year' => 'date_format:"Y"',
                'format' => 'string',
            ]
        ];
    }
}
