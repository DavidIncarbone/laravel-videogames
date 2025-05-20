#Creare e cofigurare un progetto in laravel 11

```bash

#Per prima cosa creiamo un progetto laravel utilizzato il prompt dei comandi digitando il seguente comando di composer:

composer create-project --prefer-dist laravel/laravel:^11.0 nome-del-progetto

Esempio:
composer create-project --prefer-dist laravel/laravel:^11.0 laravel-primi-passi

#Una volta creato ed aperto il progetto (si può aprire dirigendosi sulla directory del progetto, cliccando col tasto destro sulla cartella
# e dal menù che compare cliccare su "Apri nel terminale", una volta aperto questo digitare:

code .

#per aprire la cartella in Visual Studio Code.

#Dopo aver aperto il terminale, selezionare il file ".env" e decommentiamo queste righe di codice (dovrebbero essere a partire dalla riga 22):

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

#Modificarle in base alle proprie impostazioni, ad esempio come di seguito:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3390
DB_DATABASE=nome-del-database
DB_USERNAME=root
DB_PASSWORD=

# aggiunta necessaria per errore collation DB
DB_COLLATION=utf8mb4_unicode_ci



# L'ultima riga di codice: DB_COLLATION=utf8mb4_unicode_ci può anche essere omessa spostandosi nel file "database.php" in: "config\database.php" e alla riga 52 commentare questa riga di codice:
'collation' => env('DB_COLLATION', 'utf8mb4_0900_ai_ci'),

così:

// 'collation' => env('DB_COLLATION', 'utf8mb4_0900_ai_ci'),


# IMPORTANTE: OVVIAMENTE BISOGNA AVER GIA' CREATO UN DATABASE con "Phpmyadmin" o con "MySQL Workbench" ed averlo associato alla riga di sopra inserendo il suo nome: DB_DATABASE=nome-del-database
# (attenzione anche alle porte, allo username e alla password del gestore di database).

# Una volta fatto tutto ciò avviamo il server dal terminale di VS Code con uno di questi due comandi:
php artisan serve
# Oppure:
php -S localhost:8000 -t public

# Dopo aver avviato il server spostarsi con il browser al link:
http://127.0.0.1:8000

# Nella pagina che si arpirà dovrebbe comparire il seguente avvertimento, che richiede di avviare una migration del database:

A table was not found
Run migrations
You might have forgotten to run your database migrations.

You can try to run your migrations using `php artisan migrate`.

Database: Running Migrations docs

# Cliccare sul pulsante RUN MIGRATIONS
# e successivamente ricaricare la pagina. Ora dovrebbe comparire il progetto appena creato con la pagina di welcome perfettamente funzionante.

#OPPURE INVECE DI CLICCARE SUL PULSANTE "RUN MIGRATIONS" E' POSSIBILE DIGITARE DAL TERMINALE DI VISUAL STUDIO CODE IL COMANDO:
php artisan migrate
#QUESTO COMANDO, COME AL CLICK DEL PULSANTE SOPRA, ESEGUIRA' I TRE SCRIPT (PRESENTI NELLA CARTELLA database/migrations/) CHE CREERANNO LE TABELLE DI DEFAULT PER IL FUNZIONAMENTO DI LARAVEL



#------------------------------------------------------------- #Compilazione Assets con Vite --------------------------------------------------------------------------------

#Configurare laravel e vite per utilizzare gli strumenti a noi più congeniali, come bootstrap 5:

#A progetto appena creato eseguiamo questi passaggi:

# 1) rimuoviamo PostCss:
npm remove postcss

# 2) installiamo tutti i pacchetti di npm:
npm i


# installiamo con composer (composer è il gestore di pacchetti di php, l'equivalente php di npm che è il gestore di pacchetti di Node JS) il gestore di UI di Laravel:
composer require laravel/ui

# Diciamo a laravel di utilizzare Bootstrap (installiamo l'interfaccia utente di Bootstrap):
php artisan ui bootstrap

# Una volta installato bootstrap digitare npm i oppure npm install per completare la procedura:
npm install

# Così da aggiungere nel progetto la cartella "node_modules" e con aggiornata ed inserita anche la cartella di bootstrap. In questo modo avremmo nel progetto
# tutti quanti gli import e tutte quante le regole in esso presenti, e di conseguenza tutti quanti gli stili di boostrap installati in locale. Non dovremmo quindi
# più fare riferimento ad un CDN esterno per importarle.

# Infine per poter eseguire il pacchetto frontend di boostrap nel nostro backend? Dobbiamo usare il suo node package maneger (npm) che lo faccia avviare.
# Quindi dobbiamo aprire un nuovo terminale e digitare il classico:
npm run dev

# Allo stesso tempo, una volta avviato npm run dev, questo andrà ad interpretare tutte le direttive di Vite, che è anch'esso un package manager frontend.
# Così il nostro programma verrà eseguito con la stilizzazione di bootstrap.

#IMPORTANTE: nel file root delle pagine andrebbe inserita anche la seguente istruzione (preferibilmente nel tag <head>...</head>), così da permettere a Laravel di cercare le risorse per Bootstrap ed SCSS:
@vite(['resources/sass/app.scss', 'resources/js/app.js'])



#--------------------------------------------------------------- Compilazione Assets Vite/Blade -----------------------------------------------------------------------------

# Possiamo utilizzare Vite anche per impacchettare le nostre immagini e permettere alla nostra applicazione di averle caricate. Per fare questo dobbiamo utilizzare il metodo glob()
# e dobbiamo importarlo nel file app.js presente nella directory "resources/js/app.js". Qui dobbiamo aggiungere le seguenti righe di codice:

import.meta.glob([
	'../img/**'
])

#In questo modo diciamo a vite di precaricare le nostre immagini e di essere sicuri che tutte le immagini che abbiamo inserito nella cartella resources/img (l'ultimo cartella
# è personalizzabile, basta inserire nella riga di sopra un: '../nome_cartella/**' al posto di img) saranno inviate al pacchetto della nostra applicazione una volta che la costruiamo.
# (Ovviamente dobbiamo anche creare la cartella "img" o "nome_cartella" in "resources")
# Questo ci servirà anche in futuro per importare tutte le immagini anche nella buil di rilascio dell'applicativo, perchè ora stiamo eseguendo l'applicazione soltanto
# in modalità sviluppo (non è ancora un'applicazione utilizzabile, per esserlo dovremo fare la build). Questi assets verranno poi versionati quando faremo la build ufficiale con il comando
# npm run build

#Infine per importare tutte le immagini nel nostro layout, affinché Blade le processi, dobbiamo usare la direttiva Vite::asset().
# Esempio (notiamo come asset sia un metodo statico, perchè richiamato con Vite::asset):
<img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Testo alternativo">

```

## --------------------------------------------------------------- AUTENTICAZIONE CON LARAVEL BREEZE Modulo 11 della specializzazione ---------------------------------------------------------------

##Installiamo laravel/breeze:
composer require laravel/breeze --dev

##Creiamo lo scaffolding di defaul con blade:
php artisan breeze:install
##DURANTE QUESTA INSTALLAZIONE CI VERRANNO RICHIESTI I SEGUENTI STEP A CUI RISPONDERE:

## 1) Which Breeze stack would you like to install?

Qui selezionare "Blade with Alpine" scrivendo sul terminale: blade

## 2) Would you like dark mode support? (yes/no) [no]

Se attivare o meno la dark mode support è a nostra discrezione

## 3) Which testing framework do you prefer?

Selezionare PHPUnit come frameword di test scrivendo sul terminale: 1 oppure PHPUnit

##SICCOME IL PACCHETTO BREEZE UTILIZZA PER GESTIRE LO STILE IL PREPROCESSORE "POSTCSS" E LA LIBRERIA DI TAILWIND (E QUINDI TUTTE LE SUE CLASSI) INVECE DI BOOTSTRAP

## per convertire tutta questa roba da Tailwind/PostCSS a Bootstrap/SASS possiamo farlo o a mano (sconsigliatissimo!) oppure possiamo installare un pacchetto reso disponibile

## dal prof Fabio Pacifici che ci permette di effettuare questa conversione in modo automatizzato.

## Quindi per modificare lo scaffolding di default per usare bootstrap dobbiamo inserire i seguenti comandi da terminale:

## 1) Installa preset laravel 9 bootstrap vite digitando da terminale (questo pacchetto effettuerà una serie di modifiche al preset originale di Breeze, consentendoci di usare Bootstrap 5.x):

composer require pacificdev/laravel_9_preset

## 2) Diciamo a Laravel che deve utilizzare come UI Bootstrap eseguendo il comando preset da terminale:

php artisan preset:ui bootstrap --auth

## 3) Aggiornare ed installare le dipendenze con il comando:

npm i

## 4) Avviare il server con il comando:

npm run dev

## --------------------------------------------------------------- END AUTENTICAZIONE CON LARAVEL BREEZE Modulo 11 della specializzazione ---------------------------------------------------------------
