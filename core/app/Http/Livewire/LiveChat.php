<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LiveChat as ModelsLiveChat;
use App\Models\User;

// LiveChat.php
class LiveChat extends Component
{
    public $messageText;
    public $perPage = 10; // Set a reasonable value for perPage
    public $showChat = false;

    protected $listeners = ['toggleChat'];

    protected $rules = [
        'messageText' => 'required|string|min:1|max:191'
    ];

    public function toggleChat()
    {
        $this->showChat = !$this->showChat;
    }
    
    public function loadMore()
    {
        return [];
    }

    public function sendMessage()
    {
        $this->validate();

        ModelsLiveChat::create([
            'user_id' => auth()->user()->id,
            'message' => $this->messageText,
        ]);

        $this->messageText = '';
    }

    public function render()
    {
        $currentOnline = User::where('updated_at', '>=', now()->subMinutes(5))->count();

        $chats = ModelsLiveChat::with('users.profile')
            ->orderByDesc('id') // Order by descending ID
            ->paginate($this->perPage);

        return view( SETTING['site_theme'] .'addons.chat-room.index', compact('chats','currentOnline'));
    }
}
