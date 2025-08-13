<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'part_code' => 'required|string|max:255',
            'serial' => 'required|string|max:255|unique:inventories',
            'bin' => 'required|string|max:255',
            'category' => 'required|in:BUFR,FAULTY,MIA,SCRAP,EXS',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:CO,OP,CL'
        ];
    }
}
