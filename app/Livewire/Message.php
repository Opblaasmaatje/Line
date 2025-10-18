<?php

namespace App\Livewire;

use Laracord\HasLaracord;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Message extends Component
{
    use HasLaracord;

    /**
     * The selected user.
     *
     * @var string
     */
    public $user;

    /**
     * The message to send.
     *
     * @var string
     */
    public $message;

    /**
     * The Discord users.
     *
     * @var array
     */
    #[Locked]
    public $members;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->members = collect($this->discord()->users->map(fn ($user) => [
            'id' => $user->id,
            'username' => $user->username,
        ]))->keyBy('id');

        return view('livewire.message')->layout('components.layouts.app');
    }

    /**
     * Send a message to the selected user.
     *
     * @return void
     */
    public function sendMessage(): void
    {
        $this->validate([
            'user' => 'required',
            'message' => 'required|min:3|max:150',
        ]);

        if (! $this->members->has($this->user)) {
            $this->addError('user', 'The selected user does not exist.');

            return;
        }

        $this
            ->message($this->message)
            ->sendTo($this->user);

        $this->reset('message');

        session()->flash('success', 'The message has been sent.');
    }
}
