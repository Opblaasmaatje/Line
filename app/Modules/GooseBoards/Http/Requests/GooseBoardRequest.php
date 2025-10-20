<?php

namespace App\Modules\GooseBoards\Http\Requests;

use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GooseBoardRequest
{
    public function rules(): array
    {
        return [
            'goose_board.name' => [
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
            'tiles' => [
                'array',
                'min:1',
            ],
            'tiles.*.name' => [
                'required',
                'string',
            ],
            'tiles.*.description' => [
                'required',
                'string',
            ],
            'tiles.*.image_url' => [
                'nullable',
                'present',
                'string',
                'url',
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
            ],
        ];
    }

    /**
     * @return array{
     *     goose_board: array{
     *         name: string,
     *         starts_at: string,
     *         ends_at: string,
     *     },
     *     tiles: array<int, array{
     *         name: string,
     *         description: string,
     *     }>,
     *     teams: array<int, array{
     *         name: string,
     *         accounts: array<int, string>
     *     }>
     * }
     */
    public function validate(array $json): array
    {
        return Validator::make($json, $this->rules())->validate();
    }
}
