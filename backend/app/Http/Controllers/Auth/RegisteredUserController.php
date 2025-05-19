<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Nome
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i :max caratteri.',

            // Email
            'email.required' => 'Il campo email è obbligatorio.',
            'email.string' => 'L\'email deve essere una stringa.',
            'email.lowercase' => 'L\'email deve essere in lettere minuscole.',
            'email.email' => 'L\'email inserita non è valida.',
            'email.max' => 'L\'email non può superare i :max caratteri.',
            'email.unique' => 'Questa email è già registrata.',

            // Password
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'La conferma della password non corrisponde.',

            // Se vuoi personalizzare anche i criteri di sicurezza della password (opzionale)
            'password.min' => 'La password deve contenere almeno :min caratteri.',
            'password.letters' => 'La password deve contenere almeno una lettera.',
            'password.mixed' => 'La password deve contenere almeno una lettera maiuscola e una minuscola.',
            'password.numbers' => 'La password deve contenere almeno un numero.',
            'password.symbols' => 'La password deve contenere almeno un simbolo.',
            'password.uncompromised' => 'Questa password è apparsa in una violazione di dati. Scegline un\'altra più sicura.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        toastr()->success("L'Admin <span class='fw-bold'> $user->name  </span> è stato registrato con successo <br>
         Effettua il Login");

        return redirect(route('admin.dashboard', absolute: false));
    }
}
