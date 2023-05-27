<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestRequest extends FormRequest
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
        if($this->method() == 'POST'){
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:admins',
                'phone' => 'required|max:255|unique:admins',
                'password' => 'required|string|min:6|max:255|confirmed',
                'password_confirmation' => 'required|same:password',
            ];
        }
        if($this->method() == 'PUT'){
            $id = $this->route('admin')->id;
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:admins,id,'.$id,
                'phone' => 'required|max:255|unique:admins,id,'.$id,
                'password' => 'nullable|string|min:6|max:255|confirmed',
                'password_confirmation' => 'nullable|same:password',
            ];
        }
        
    }
}
