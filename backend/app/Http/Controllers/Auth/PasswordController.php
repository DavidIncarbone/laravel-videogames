<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {

        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ],
            [
                'current_password.required' => 'Il campo password attuale è richiesto',
                'current_password.current_password' => 'La password inserita non corrisponde con quella attuale',

                'password.required' => 'Il campo nuova password è richiesto',
            ]
        );

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);


        toastr()->success('Password aggiornata con successo');

        return back()->with('status', 'password-updated');
    }
}
