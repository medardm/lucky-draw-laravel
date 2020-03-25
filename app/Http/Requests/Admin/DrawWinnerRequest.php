<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DrawTicket;

class DrawWinnerRequest extends FormRequest
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
            'prize_id' => 'required|integer|exists:prizes,id',
            'generate_randomly' => 'required|string',
            'ticket_number' => [
                'exclude_if:generate_randomly,true',
                'required',
                'string',
                'exists:draw_tickets,ticket_number',
                function ($attribute, $value, $fail) {
                    if (DrawTicket::hasPrize($value)) {
                        $fail("Ticket # $value belongs to a winner, please choose a different ticket number");
                    };
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'prize_id.required' => 'You must select a prize',
            'prize_id.exists' => 'Invalid prize',
            'generate_randomly.required' => 'You must indicate whether the winning ticket is to be generated or not',
            'ticket_number.exists' => 'Nobody owns a ticket # :attribute',
            'ticket_number.required' => 'You need to specify a winning number',
        ];
    }
}
