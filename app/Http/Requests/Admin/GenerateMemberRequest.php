<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class GenerateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('view-admin-pages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number_of_users' => 'required|integer|max:5',
            'generate_ticket' => 'required|string|max:5',
            'number_of_tickets' => [
                'exclude_if:generate_ticket,false',
                'required',
                'integer',
                'max:10',
            ],
        ];
    }

    public function messages()
    {
        return [
            'number_of_tickets.required' => 'You must specify the :attribute',
            'number_of_tickets.integer' => 'You must specify the :attribute'
        ];
    }
}
