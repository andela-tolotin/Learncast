<?php

namespace LearnCast\Http\Requests;

use Auth;

class UserSignupRequest extends Request
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
            'username'    => 'required|max:50|unique:users,username,'.Auth::user()->id,
            'email'       => 'required|email|max:50|unique:users,email,'.Auth::user()->id,
            'profile_bio' => 'required|min:5',
        ];
    }
}
