<?php

namespace App\SlashCommands\Admin;

use App\Laracord\Option;
use App\Laracord\SlashCommands\BaseSlashCommand;
use App\Laracord\SlashCommands\Concerns\AdminCommand;
use App\Library\Services\AdminService;
use Illuminate\Support\Facades\App;

class SetAdmin extends BaseSlashCommand
{
    use AdminCommand;

    protected $name = 'set-admin';

    protected $description = 'Set an admin status for a user.';

    public function handle($interaction)
    {
        $user = $this->adminService()->setAdmin(
            (string) $this->value('user'),
            (bool) $this->value('is-admin')
        );

        return $interaction->respondWithMessage(
            $this
                ->message("Successfully changed admin status")
                ->title("User with ID [{$user->discord_id}] is now Admin")
                ->field('Is admin: ', $user->is_admin ? 'Yes' : 'No')
                ->success()
                ->build()
        );
    }

    public function options(): array
    {
        return [
            Option::make($this->discord())
                ->setType(Option::USER)
                ->setName('user')
                ->setDescription('The user to make or remove admin privileges for.')
                ->setRequired(true),

            Option::make($this->discord())
                ->setType(Option::BOOLEAN)
                ->setName('is-admin')
                ->setDescription('The admin flag')
                ->setRequired(true),
        ];
    }

    protected function adminService(): AdminService
    {
        return App::make(AdminService::class);
    }
}
