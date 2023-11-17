<?php

use App\Models\User;
use App\Notifications\VerificationCodeNotification;
use App\ValueObjects\VerificationCode;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    #[Rule([
        'nullable',
        "required_if:phone,null",
        'string',
        'email'
    ], message: ["required_if" => "O campo :attribute deve ser preenchido."])]
    public ?string $email = null;

    #[Rule([
        'nullable',
        'required_if:email,null',
        'string'
    ], as: "celular", message: ["required_if" => "O campo :attribute deve ser preenchido."])]
    public ?string $phone = null;

    public ?string $name = null;

    public string $verificationCode;

    public string $loginStep = '';

    public function login(): void
    {
        $user = User::findByEmail($this->email ?? "");

        if (is_null($user)) {
            throw ValidationException::withMessages(["verification-code" => "Usuário não cadastrado."]);
        }

        if ($this->verificationCode !== $user->verification_code->getNumber()) {
            throw ValidationException::withMessages(
                ["verification-code" => "Código inválido." . $user->verification_code->getNumber()]
            );
        } elseif ($user->verification_code_expiration < now()) {
            throw ValidationException::withMessages(["verification-code" => "Código expirado."]);
        }

        auth()->login($user);
        session()->regenerate();
        $this->redirect(route("home"));
    }

    public function emailLogin()
    {
        $this->validate();
        $user = User::findByEmail($this->email);

        if (is_null($user)) {
            $this->loginStep = "register";
            return;
        }

        $verificationCode = new VerificationCode();

        $user->verification_code = $verificationCode;
        $user->verification_code_expiration = now()->addMinutes(5);
        $user->save();
        $this->sendVerificationCodeMail($verificationCode);

        $this->loginStep = 'verify';
    }

    public function registerWithEmail()
    {
        $this->validate();
        $this->validate(["name" => ["required", "string", "min:2"]], attributes: ["name" => "nome"]);
        $verificationCode = new VerificationCode();
        User::create([
            "email" => $this->email,
            "name" => $this->name,
            "verification_code_expiration" => now()->addMinutes(5),
            "verification_code" => $verificationCode,
        ]);
        $this->sendVerificationCodeMail($verificationCode);
        $this->loginStep = 'verify';
    }

    private function sendVerificationCodeMail(VerificationCode $verificationCode)
    {
        Notification::route("mail", [$this->email => $this->name])
            ->notify(new VerificationCodeNotification($verificationCode));
    }
}; ?>

<main>
    <button x-show="$wire.loginStep !== ''"
            @click="$wire.loginStep = ''"
            class="absolute top-6 left-4">
        <x-icon.chevron-left/>
    </button>

    <section x-show="!$wire.loginStep">
        <div class="text-center">
            <p class="text-4xl text-gray-700 font-bold mb-8">Falta pouco para matar sua fome!</p>
            <p class="text-gray-500 font-semibold text-xl mb-8">Como deseja continuar?</p>
        </div>
        <div class="mb-8">
            <a href="{{ route('auth.google-redirect') }}"
               class="relative text-center block py-4 px-3 border rounded">
                <x-icon.google class="absolute"/>
                Fazer Login com o google
            </a>
        </div>
        <div class="mb-8">
            <a href="{{ route('auth.facebook-redirect') }}"
               class="relative text-center block py-4 text-white font-semibold px-3 border rounded bg-blue-600">
                Facebook
            </a>
        </div>
        <div>
            <div class="flex flex-row gap-6 justify-between items-center text-gray-400">
                <button @click="$wire.loginStep = 'phone'"
                        class="border rounded w-full py-4 font-bold hover:text-white hover:bg-red-600">
                    Celular
                </button>

                <button @click="$wire.loginStep = 'email'"
                        class="border rounded w-full py-4 font-bold hover:text-white hover:bg-red-600">
                    E-mail
                </button>
            </div>
        </div>
    </section>
    <section x-show="$wire.loginStep === 'email'">
        <p class="text-center text-gray-500 text-lg font-medium mt-10 mb-8">Informe o seu e-mail para continuar</p>
        <x-input-error :messages="$errors->get('email')" class="mb-2"/>
        <input type="email"
               id="email"
               wire:model="email"
               placeholder="Informe o seu e-mail"
               class="focus:ring-0 border-gray-300 px-4 py-3 border rounded w-full focus:border-gray-300 mb-8 font-medium text-gray-400 peer-focus:outline-none">
        <button class="text-white bg-red-600 hover:bg-red-500 w-full py-4 rounded"
                wire:click="emailLogin()">
            Continuar
        </button>
    </section>
    <section x-show="$wire.loginStep === 'phone'">
        <p class="text-center text-gray-500 text-lg font-medium mt-10 mb-8">
            Informe o número do seu celular para continuar
        </p>
        <div class="grid grid-cols-4 mb-8 gap-4">
            <div class="bg-gray-100 rounded col-span-1 flex items-center justify-center">+55</div>
            <x-input-error :messages="$errors->get('phone')" class="mb-2"/>
            <input type="email"
                   id="email"
                   placeholder="Informe o número do seu celular"
                   class="col-span-3 focus:ring-0 border-gray-300 px-4 py-3 border rounded w-full focus:border-gray-300 font-medium text-gray-400 peer-focus:outline-none">
        </div>
        <button class="text-white bg-red-600 hover:bg-red-500 w-full py-4 rounded">WhatsApp</button>
    </section>
    <section x-show="$wire.loginStep === 'register'">
        <p class="text-center text-gray-500 text-lg font-medium mt-10 mb-8">Informe o seu nome para continuar</p>
        <x-input-error :messages="$errors->get('name')" class="mb-2"/>
        <input type="text"
               id="name"
               wire:model="name"
               placeholder="Informe o seu nome"
               class="focus:ring-0 border-gray-300 px-4 py-3 border rounded w-full focus:border-gray-300 mb-8 font-medium text-gray-400 peer-focus:outline-none">
        <button class="text-white bg-red-600 hover:bg-red-500 w-full py-4 rounded"
                wire:click="registerWithEmail()">
            Continuar
        </button>
    </section>
    <section x-show="$wire.loginStep === 'verify'">
        <p class="text-center text-gray-500 text-lg font-medium mt-10 mb-8">Digite o código enviado para o seu
            E-mail</p>
        <x-input-error :messages="$errors->get('verification-code')" class="mb-2"/>
        <input type="text"
               id="verification-code"
               wire:model="verificationCode"
               class="focus:ring-0 border-gray-300 px-4 py-3 border rounded w-full focus:border-gray-300 mb-8 font-medium text-gray-400 peer-focus:outline-none">
        <button class="text-white bg-red-600 hover:bg-red-500 w-full py-4 rounded"
                wire:click="login()">
            Validar
        </button>
    </section>
</main>
