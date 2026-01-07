<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;

class CustomLogin extends Login
{
    protected static ?string $title = 'SIMKA - BAPETEN';

    protected string $view = 'filament.pages.auth.custom-login';

    public function getLayout(): string
    {
        return 'filament-panels::components.layout.base';
    }
}
