<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>



<div class="signinandreserve">
    @auth
    <button wire:click="logout" class="w-full text-start !bg-transparent">
        <x-dropdown-link>
            {{ __('Log Out') }}
        </x-dropdown-link>
    </button>

    @else
    <a href="{{ route('login') }}" class="sign">Sign in </a>
    @endauth
    <a href="{{ route('reservations') }}" class="reservation">Reservations</a>
</div>
