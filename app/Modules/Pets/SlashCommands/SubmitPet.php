<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\Button;
use App\Laracord\SlashCommands\SlashCommandWithAccount;
use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\SlashCommands\Concerns\HasImage;
use App\Modules\Pets\SlashCommands\Concerns\HasPet;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\MessageComponent;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use React\Promise\PromiseInterface;

class SubmitPet extends SlashCommandWithAccount
{
    use HasPet;
    use HasImage;

    protected $name = 'pet-submit';

    protected $description = 'Submit a pet';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return array_merge(parent::options(), [
            $this->getPetOption($this->discord()),
            $this->getImageOption($this->discord()),
        ]);
    }

    protected function action(ApplicationCommand|Ping $interaction, Account $account): PromiseInterface
    {
        $attachment = $this->getImage($interaction);

        if (! Str::startsWith($attachment->content_type, 'image/')) {
            return $interaction->respondWithMessage(
                $this
                    ->message('Invalid Image!')
                    ->title('Invalid image submitted!')
                    ->body('Please try again with a valid image.')
                    ->error()
                    ->build()
            );
        }

        $pet = $this->getPetService()->createPet(
            $account,
            PetName::from($this->value('pet')),
            $attachment->url,
        );

        return $interaction->respondWithMessage(
            $this
                ->message("Submitted pet approval for {$pet->name->value}.")
                ->success()
                ->title("Successfully submitted pet approval for {$pet->name->value}!")
                ->imageUrl($pet->image_url)
                ->content('An admin will approve or deny your pet submission.')
                ->build()
        )->then(
            function () use ($interaction, $pet) {
                return $interaction->respondWithMessage(
                    $this // @phpstan-ignore argument.type
                        ->message('Please review the pet submission!')
                        ->title('Please review the pet submission!')
                        ->info()
                        ->imageUrl($pet->image_url)
                        ->button(
                           label: 'Approve',
                           route: "approve:{$pet->getKey()}",
                        )
                        ->button(
                            label: 'Deny',
                            style: Button::STYLE_DANGER,
                            route: "deny:{$pet->getKey()}",
                        )
                        ->send(Config::get('app.pet.discord-channel')),
                );
            }
        );
    }

    public function interactions(): array
    {
        return [
            'approve:{pet}' => fn (MessageComponent $interaction, string $pet) => $interaction
                ->acknowledge()
                ->then(fn () => $this->getPetService()->approve(
                    $this->getPetService()->repository->find($pet)
                )),
            'deny:{pet}' => fn (MessageComponent $interaction, string $pet) => $interaction
                ->acknowledge()
                ->then(fn () => $this->getPetService()->reject(
                    $this->getPetService()->repository->find($pet)
                )),
        ];
    }

    public function autocomplete(): array
    {
        return [
            'pet' => $this->getPetAutocompletion(),
        ];
    }
}
