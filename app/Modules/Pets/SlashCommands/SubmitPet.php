<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\Option;
use App\Laracord\SlashCommands\SlashCommandWithAccount;
use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\SlashCommands\Concerns\HasPet;
use Discord\Builders\Components\Button;
use Discord\Parts\Channel\Attachment;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\MessageComponent;
use Discord\Parts\Interactions\Ping;
use Illuminate\Support\Facades\Config;
use React\Promise\PromiseInterface;

class SubmitPet extends SlashCommandWithAccount
{
    use HasPet;

    protected $name = 'pet-submit';

    protected $description = 'Submit a pet';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return array_merge(parent::options(), [
            $this->getPetOption($this->discord()),

            Option::make($this->discord())
                ->setName('image')
                ->setDescription('Upload image as proof.')
                ->setType(Option::ATTACHMENT)
                ->setRequired(true),
        ]);
    }

    protected function action(ApplicationCommand|Ping $interaction, Account $account): PromiseInterface
    {
        $attachment = $this->getImage($interaction);

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
                    $this
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

    private function getImage(ApplicationCommand $interaction): Attachment
    {
        return collect($interaction->data->resolved->attachments)->first();
    }
}
