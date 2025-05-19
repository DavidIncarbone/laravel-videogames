<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        {{-- FONT AWESOME --}}
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            rel="stylesheet"
        />

        {{-- BOOTSTRAP ICONS --}}
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        />

        {{-- DROPZONE.JS --}}
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Gestionale Videogames</title>

        @vite(["resources/sass/app.scss", "resources/js/app.js"])
    </head>

    <body>
        <div class="wrapper">
            @include("partials.sidebar")

            <div class="content container-fluid px-3">
                @yield("content")
            </div>
        </div>

        @include("partials.logout-modal")
    </body>
</html>
