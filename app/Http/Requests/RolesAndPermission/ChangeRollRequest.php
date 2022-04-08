<?php

namespace App\Http\Requests\RolesAndPermission;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRollRequest extends FormRequest
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
            'oldrole'   => ['required','exists:roles,name'],
            'newrole'   => ['required','exists:roles,name'],
            'user_id'   => ['required','exists:users,id'],
        ];
    }
}

