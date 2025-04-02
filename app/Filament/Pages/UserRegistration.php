<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Classroom;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Illuminate\Auth\Events\Registered;
use Filament\Forms\Components\TextInput;

class UserRegistration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user-registration';

    public $data = [];

    public function form(Form $form): Form
    {
        $classes = Classroom::all()->pluck('name', 'id');

        return $form
            ->schema([
                
            TextInput::make('name')
                ->label('Full Name')
                ->required(),

            TextInput::make('username')
                ->label('Username')
                ->required()
                ->unique('users', 'username'),

            Select::make('class')
                ->options($classes),

            Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'teacher' => 'Teacher',
                    'student' => 'Student',
                ]),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required()
                ->minLength(8),

            TextInput::make('password_confirmation')
                ->label('Confirm Password')
                ->password()
                ->same('password')
                ->required(),

            Actions::make([
                Action::make('register')
                    ->label('Register')
                    ->submit('register'),
            ])->fullWidth(),
    
            ])
            ->columns(1)
            ->statePath('data');
    }

    public function register(){
        $data = $this->form->getState();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        if(isset($data['class'])){
            $user->classes()->attach($data['class']);
        }
        $user->addRole($data['role']);

        event(new Registered($user));

        return redirect()->refresh();
    }
}
