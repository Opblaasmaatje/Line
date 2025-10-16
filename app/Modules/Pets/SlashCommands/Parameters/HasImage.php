<?php

namespace App\Modules\Pets\SlashCommands\Parameters;

use App\Laracord\Option;
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
        $this->addBeforeCallback(function (Interaction $interaction) {
            if (! $this->value('image')) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Image not given as parameter!')
                        ->error()
                        ->content('Image not given as parameter!')
                        ->build()
                );
            }

            $attachment = $this->getImage($interaction);

            if (! Str::startsWith($attachment?->content_type, 'image/')) {
                return $interaction->respondWithMessage(
                    $this
                        ->message('Image is not a valid image!')
                        ->warning()
                        ->content('Image is not a valid image!')
                        ->build()
                );
            }

            $this->image = $attachment;
        });
    }

    protected function getImage(ApplicationCommand|Interaction $interaction): Attachment|null
    {
        return collect($interaction->data->resolved->attachments)->first();
    }
}
