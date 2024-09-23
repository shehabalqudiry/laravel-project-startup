<?php

namespace Modules\MasterData\App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $roles = [] ;

        // foreach (config('myConfig.langs') as $lang)
        // {
        //     $roles ['name.'.$lang] = 'required|unique:countries,name->'.$lang.',NULL,id,deleted_at,NULL';
        // }

        $roles =
            [
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users,email,'. $this->user()->id,'email:rfc,dns'],
                'password' => ['required','string','min:8'],
                'status' => 'required|in:0,1',
                // 'image' => 'nullable|file|image|mimes:png,jpg,jpeg|max:5000',
            ];

        return $roles;
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.en.required' => trans('validation.required'),
            'name.ar.required' => trans('validation.required'),
            'name.required' => trans('validation.required'),
            'name.string'   => trans('validation.string'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
