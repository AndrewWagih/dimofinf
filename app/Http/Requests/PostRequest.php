<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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

        $data = [
            'title' => 'required|max:255',
            'description' => 'required|max:2048',
            'contact_phone_number' => 'required|max:255'
        ];
        if(!auth('api')->check()){
            $data['user_id'] = ['required',Rule::in(User::pluck('id'))];
        }
        return $data;
    }
}
