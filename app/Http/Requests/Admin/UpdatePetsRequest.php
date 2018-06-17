<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetsRequest extends FormRequest
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
            
            'tag_id' => 'unique:pets,tag_id,'.$this->route('pet'),
            'pet_photo' => 'nullable|mimes:png,jpg,jpeg,gif',
            'pet_name' => 'min:3|max:191|required',
            'pet_color' => 'min:1|max:191',
            'pet_age' => 'max:50',
            'distinctive_sign' => 'min:1|max:191',
        ];
    }
}
