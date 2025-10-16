<?php

namespace App\Modules\Pets\SlashCommands;

use App\Laracord\Button;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\SlashCommands\Concerns\HasPet;
use App\Modules\Pets\SlashCommands\Parameters\HasImage;
use App\Modules\Pets\SlashCommands\Parameters\HasPetName;
use App\Wise\SlashCommands\Parameters\HasAccount;
use Discord\Parts\Channel\Attachment;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Interaction;
use Discord\Parts\Interactions\MessageComponent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use React\Promise\PromiseInterface;

class SubmitPet extends BaseSlashCommand
{
    use HasAccount;
    use HasPetName;
    use HasImage;

    protected $name = 'pet-submit';

    protected $description = 'Submit a pet';

    protected $permissions = [];

    protected $admin = false;

    protected $hidden = false;

    public function options(): array
    {
        return [
            $this->getAccountOption($this->discord()),
            $this->getPetNameOption($this->discord()),
            $this->getImageOption($this->discord()),
        ];
    }

    public function handle($interaction): PromiseInterface
    {
        $pet = $this->getPetService()->createPet(
            $this->account,
            $this->petName,
            $this->image->url,
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

    protected function getPetService(): PetService
    {
        return App::make(PetService::class);
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
            'pet-name' => $this->getPetNameAutocompleteCallback(),
        ];
    }
}
