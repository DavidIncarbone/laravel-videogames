<h1>LARAVEL VIDEOGAMES</h1>

<h2>OVERVIEW</h2>

<p>WebApp completa sviluppata in autonomia a tema videogames, con l'obiettivo lato Backend di realizzare un <b>Back Office</b> che gestisca tramite <b>CRUD</b> tutte le entità del Database e lato Frontend di realizzare una <b>Landing Page</b> con l'obiettivo di mostrare la lista di tutte le entità e i relativi dettagli </p>

<h2>BACKEND</h2>

<h3>DATABASE</h3>

<p><b>Database relazionale</b> la cui progettazione è avvenuta tramite <b>Draw.io</b>, mentre la creazione e la gestione iniziale attraverso <b>PHP MyAdmin.</b> </br>

<b>Migrations & Seeders</b> sono stati invece fatti interamente in <b>Laravel</b> con l'ausilio del suo <b>ORM Eloquent</b>, incluse le <b>Foreign Key.</b>

</p>

<h3>BACK OFFICE</h3>

 <img src="https://github.com/user-attachments/assets/7c622646-0148-4e5c-b477-9d64b530d36a" alt="Demo" width="600" />

<p>Il <b>Back Office</b> si presenta con una <b>sidebar</b> onnipresente, che permette di navigare agevolmente fra tutte le entità del <b>Database</b>.</br>
La realizzazione del <b>Back Office</b> è stata eseguita in <b>Laravel</b> con autenticazione gestita da <b>Laravel Breeze</b>, che garantisce l'accesso solo agli utenti registrati.
Il <b>Back Office</b> consente agevolmente di applicare tutte le <b>CRUD</b> alle entità del <b>Database</b>, con possibilità anche di <b>eliminazione mirata</b> (grazie ad una <b>searchbar</b> e a dei <b>filtri specifici</b> per ogni entità) ed <b>eliminazione multipla</b> (con delle <b>checkbox</b> per la <b>multi-selezione<b>)</br>
Sia il <b>Back Office</b> che la <b>Landing Page</b> sono totalmente <b>responsive</b>, quindi agevolmente navigabili sia da <b>tablet</b> che da <b>smartphone</b>.

<p>Il <b>Back End</b> mette inoltre a disposizione delle <b>rotte API</b> per il fetch delle risorse.</p>

<h4>TECONOLOGIE UTILIZZATE</h4>

<ul>
<li>PHP/Laravel, con l'ORM Eloquent per le query al Database</li>
<li>Laravel Breeze per la gestione dell'autenticazione</li>
<li>HTML, CSS + Bootstrap per le views del Back Office</li>
<li>Javascript Vanilla per gestire l'interattività delle views</li>
</ul>

<h2>FRONTEND</h2>

 <img src="https://github.com/user-attachments/assets/4ab3084d-5b5d-4c7b-84ec-d02c41cfbe04" alt="Demo" width="600" />

<p>Fronted realizzato con <b>React.js</b> costituito da un'<b>Homepage</b> che mostra un <b>Carosello</b> con le ultime uscite e due <b>slider<b> che permettono già di filtrare per console e generi. Una <b>searchbar globale<b> è presente in qualsiasi pagina dell'applicazione, facendo parte dell'header, che ci permetterà di effettuare una <b>ricerca rapida</b> inserendo il nome del videogioco.</br>
Inoltre è presente una pagina di <b>filtro avanzato</b>, dove è possibile utilizzare dei <b>filtri multipli</b> per ricerche <b>super mirate</b>. </br>
Conclude la <b>Landing Page</b> una <b>pagina di dettaglio</b> per ogni singolo videogioco, con annesse tutte le caratteristiche correlate</p>

<h4>TECONOLOGIE UTILIZZATE</h4>

<ul>
<li>HTML</li>
<li>CSS + Bootstrap</li>
<li>React.js</li>
</ul>

<h1>TASK</h1>

<h2>Progetto Finale</h2> 
 <h3>Descrizione</h3>
 
L’obiettivo di questo progetto è creare un backoffice in Laravel e un frontend in React per gestire e visualizzare un insieme di dati a vostra scelta.

<h4>Parte 1: Backoffice in Laravel</h4>
Dovrete sviluppare un backoffice con autenticazione gestita da Laravel Breeze. Una volta loggato, l'utente potrà gestire un'entità a scelta, come:

- Videogiochi 🎮
- Film 🎬
- Album musicali 💿
- Libri o Fumetti📚
  …o qualsiasi altra entità vi venga in mente!

Per questa entità dovrete implementare tutte le operazioni CRUD (Creazione, Lettura, Aggiornamento, Eliminazione).

Oltre a questa, dovrà esserci almeno una seconda entità collegata alla prima con una relazione 1-N o N-N.

Esempi:

- Se avete scelto i videogiochi, potreste avere la tabella delle console su cui è disponibile un gioco (PS5, Xbox, Switch).
- Se avete scelto i film, potreste collegarli ai generi cinematografici (Azione, Commedia, Horror).
- Potreste anche scegliere di avere 2 entità relazionate, ad esempio, nel caso di videogiochi, sia la console che il genere (Avventura, Picchiaduro, GDR)

Tutto il backoffice deve essere realizzato usando Blade, ma potete aiutarvi con JS per eventuali necessità di logiche frontend. Siete anche liberi di usare librerie JavaScript esterne se vi torna comodo.

<h4>Parte 2: Sito guest in React</h4>
Per i visitatori non autenticati (guest) dovrete creare un'app in React che permetta di:

✅ Visualizzare la lista degli elementi (videogiochi, film, ecc.)
✅ Vedere i dettagli di un singolo elemento
✅ Mostrare anche le informazioni collegate (es. le categorie di appartenenza)

Questa app dovrà comunicare con il backend tramite chiamate AJAX ad API REST, quindi nel backend dovrete creare un set di endpoint API per recuperare i dati.
🎯Obiettivo
Alla fine di questo progetto avrete realizzato un’app completa con:
✅ Un backoffice in Laravel con autenticazione e gestione CRUD
✅ Un frontend in React che mostra i dati in modo chiaro e interattivo
✅ Relazioni tra le entità per una gestione più realistica delle informazioni

💡 Consigli

- Strutturate bene le relazioni nel database prima di partire.
- Usate Postman o strumenti simili per testare le API.
- Curate l’UI del frontend per rendere la navigazione intuitiva.
  Buon lavoro! 🚀
