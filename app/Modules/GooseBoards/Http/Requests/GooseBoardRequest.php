<?php

namespace App\Modules\GooseBoards\Http\Requests;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GooseBoardRequest
{
    public function rules(): array
    {
        return [
            'goose_board.name' =>[
                'required',
                'string',
            ],
            'goose_board.starts_at' => [
                'required',
                Rule::date()->format('Y-m-d'),
                'after_or_equal:today',
                'before:goose_board.ends_at',
            ],
            'goose_board.ends_at' => [
                'required',
                Rule::date()->format('Y-m-d'),
                'after:goose_board.starts_at',
            ],
            'teams' => [
                'array',
                'min:1',
            ],
            'teams.*.name' => [
                'required',
                'string',
            ],
            'teams.*.accounts' => [
                'required',
                'array',
                'min:1',
                Rule::exists(Account::class, 'username'),
            ]
        ];
    }

    public function validate(array $json): array
    {
        return Validator::make($json, $this->rules())->validate();
    }
}
