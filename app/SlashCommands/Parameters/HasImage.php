<?php

namespace App\SlashCommands\Parameters;

use App\Laracord\Option;
use App\Laracord\SlashCommands\ValidatableCallback;
use Discord\DiscordCommandClient;
use Discord\Parts\Channel\Attachment;
use Discord\Parts\Interactions\ApplicationCommand;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Support\Str;

trait HasImage
{
    protected Attachment $image;

    protected function getImageOption(DiscordCommandClient $discord)
    {
        return Option::make($discord)
            ->setName('image')
            ->setDescription('Upload image as proof.')
            ->setType(Option::ATTACHMENT)
            ->setRequired(true);
    }

    protected function bootHasImage(): void
    {
        $validatableCallback = new ValidatableCallback(function (Interaction $interaction) {
            if (! $this->value('image')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('Image not given as parameter!')
                        ->error()
                        ->content('Image not given as parameter!')
                        ->build()
                );

                return false;
            }

            $attachment = $this->getImage($interaction);

            if (! Str::startsWith($attachment?->content_type, 'image/')) {
                $interaction->respondWithMessage(
                    $this
                        ->message('Image is not a valid image!')
                        ->warning()
                        ->content('Image is not a valid image!')
                        ->build()
                );

                return false;
            }

            $this->image = $attachment;

            return true;
        });

        $this->addBeforeCallback($validatableCallback);
    }

    protected function getImage(ApplicationCommand|Interaction $interaction): Attachment|null
    {
        return collect($interaction->data->resolved->attachments)->first();
    }
}
