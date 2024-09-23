<?php

namespace Modules\MasterData\App\Http\Requests\Dashboard\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // 'name' =>'required|string|max:255',
            'display_name' =>'required|string|max:255',
            'permissions' =>'required|array',
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
