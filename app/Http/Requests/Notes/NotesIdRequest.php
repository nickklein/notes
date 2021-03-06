<?php

namespace notes\Http\Requests\Notes;

use Illuminate\Foundation\Http\FormRequest;

class NotesIdRequest extends FormRequest
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
            //
            'page_id' => 'required|integer',
        ];
    }
}
