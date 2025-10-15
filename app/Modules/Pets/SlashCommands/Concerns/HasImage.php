<?php

namespace App\Modules\Pets\SlashCommands\Concerns;

use App\Laracord\Option;
use App\Modules\Pets\Models\Pet;
use Discord\DiscordCommandClient;
use Discord\Parts\Channel\Attachment;
use Discord\Parts\Interactions\ApplicationCommand;

trait HasImage
{
    protected function getImageOption(DiscordCommandClient $discord)
    {
        return Option::make($discord)
            ->setName('image')
            ->setDescription('Upload image as proof.')
            ->setType(Option::ATTACHMENT)
            ->setRequired(true);
    }

    protected function getImage(ApplicationCommand $interaction): Attachment
    {
        return collect($interaction->data->resolved->attachments)->first();
    }
}
