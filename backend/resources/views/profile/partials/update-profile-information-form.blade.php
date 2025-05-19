<section>
    <header>
        <h2 class="text-secondary">
            {{ __("Informazioni del profilo") }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __("Aggiorna le informazioni del tuo profilo e l'indirizzo e-mail") }}
        </p>
    </header>

    <form
        id="send-verification"
        method="post"
        action="{{ route("verification.send") }}"
    >
        @csrf
    </form>

    <form
        method="post"
        action="{{ route("admin.profile.update") }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method("patch")

        <div class="mb-2">
            <label for="name">{{ __("Nome") }}</label>
            <input
                class="form-control"
                type="text"
                name="name"
                id="name"
                autocomplete="name"
                value="{{ old("name", $user->name) }}"
                autofocus
            />
            {{--
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('name') }}</strong>
                </span>
                @enderror
            --}}
            @error("name")
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-2">
            <label for="email">
                {{ __("Email") }}
            </label>

            <input
                id="email"
                name="email"
                type="text"
                class="form-control"
                value="{{ old("email", $user->email) }}"
                autocomplete="username"
            />

            @error("email")
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-muted">
                        {{ __("Your email address is unverified.") }}

                        <button
                            form="send-verification"
                            class="btn btn-outline-dark"
                        >
                            {{ __("Click here to re-send the verification email.") }}
                        </button>
                    </p>

                    @if (session("status") === "verification-link-sent")
                        <p class="mt-2 text-success">
                            {{ __("A new verification link has been sent to your email address.") }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4">
            <button class="btn btn-dark mt-1" type="submit">
                {{ __("Salva") }}
            </button>

            @if (session("status") === "profile-updated")
                <script>
                    const show = true;
                    setTimeout(() => (show = false), 2000);
                    const el = document.getElementById('profile-status');
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id="profile-status" class="badge bg-success p-2 mt-2">
                    {{ __("Salvato.") }}
                </p>
            @endif
        </div>
    </form>
</section>
