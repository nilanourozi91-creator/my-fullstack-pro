<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class updeteprodectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'nullable|string|max:3',
            'price'=>'nullable|integer',
            'brand'=>'nullabl|string',
            'stock'=>'nullable|integer',
            'addcatagorys'=>'nullable|string',
            'brand'=>'nullable|string',
            'img_url'=>'nullable|string',
            'imegeable_type'=>'required|file|mimes:png,jpg,gif,webpt',
            'imegeable_id'=>'required|integer',
        ];
    }
}
