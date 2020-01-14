<?php

namespace notes\Http\Requests\Notes;

use Illuminate\Foundation\Http\FormRequest;

class NotesUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'caption' => 'nullable|string',
            'content' => 'required|string',
            'page_id' => 'required|integer',
        ];
    }
}
