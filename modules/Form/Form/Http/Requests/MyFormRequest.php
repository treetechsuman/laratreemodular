<?php

namespace Modules\Form\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'slag' => 'required',
            'submit_url'=>'required',
            'query_params'=>'required',
            'version' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
