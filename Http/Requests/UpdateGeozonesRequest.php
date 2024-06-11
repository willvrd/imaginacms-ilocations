<?php

namespace Modules\Ilocations\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateGeozonesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:2|max:30|required',
            'description' => 'max:100|required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
