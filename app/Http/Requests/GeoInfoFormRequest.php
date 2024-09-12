<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeoInfoFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return request()->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function rulesStore()
    {
        return [
            'ip' => ['required', 'string', 'ip']
        ];
    }

    public function rulesUpdate()
    {
        return [
            'ip' => ['sometimes',' string', 'ip']
        ];
    }
}
