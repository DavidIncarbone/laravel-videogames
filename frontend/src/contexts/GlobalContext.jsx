// Creazione della GlobalContext che conterrà tutte le chiamate API al server
import { createContext, useContext, useState } from "react";
import axios from "axios";

//creo il Context e gli do il nome GlobalContext

const GlobalContext = createContext();


// Creo il provider customizzato:
const GlobalProvider = ({ children }) => {

    // ***** VARIABLES *****

    const apiUrl = import.meta.env.VITE_API_URL;
    const fileUrl = import.meta.env.VITE_BACKEND_FILE_URL;

    // VIDEOGAMES

    const homepageEndpoint = "homepage";
    const [homepageVideogames, setHomeVideogames] = useState([]);

    const endpoint = "videogames/";
    const [videogames, setVideogames] = useState([]);

    const videogameEndpoint = `videogame/`;
    const [videogame, setVideogame] = useState({});

    const [isLoading, setIsLoading] = useState(true);

    // CONSOLE

    const consolesEndpoint = "consoles";
    const [consoles, setConsoles] = useState([]);

    // GENRES

    const genresEndpoint = "genres";
    const [genres, setGenres] = useState([]);

    // PEGI

    const pegisEndpoint = "pegis";
    const [pegis, setPegis] = useState([]);


    //   ***** FUNCTIONS *****

    // VIDEOGAMES

    const fetchHomepageVideogames = () => {
        axios.get(apiUrl + endpoint + homepageEndpoint).then((res) => {
            setIsLoading(false);
            console.log("ultimi 4 videogiochi", res.data);
            const latestFour = res.data.items;
            setHomeVideogames(latestFour);
        })
    }

    const fetchVideogames = () => {
        axios.get(apiUrl + endpoint).then((res) => {
            setIsLoading(false);
            console.log("videogiochi", res.data.items.data);
            const videogames = res.data.items.data;
            setVideogames(videogames);

        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai videogiochi effettuata");
        });
    };

    const fetchVideogame = (slug) => {
        axios.get(apiUrl + videogameEndpoint + slug).then((res) => {
            setIsLoading(false);
            console.log("Videogioco attuale", res.data);
            const videogame = res.data.item;
            setVideogame(videogame)
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log(`Chiamata al videogioco effettuata`);
        });
    }

    // CONSOLE

    const fetchConsoles = () => {
        axios.get(apiUrl + consolesEndpoint).then((res) => {
            setIsLoading(false);
            console.log("console", res.data);
            const consoles = res.data.items;
            setConsoles(consoles);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata alle Console effettuata");
        });
    }

    // GENRES

    const fetchGenres = () => {
        axios.get(apiUrl + genresEndpoint).then((res) => {
            setIsLoading(false);
            console.log("generi", res.data);
            const genres = res.data.items;
            setGenres(genres);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai Generi effettuata");
        });
    }

    // PEGI

    const fetchPegis = () => {
        axios.get(apiUrl + pegisEndpoint).then((res) => {
            setIsLoading(false);
            console.log("PEGI", res.data);
            const pegis = res.data.items;
            setPegis(pegis);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai PEGI effettuata");
        });
    }



    const data = {
        homepageVideogames,
        fetchHomepageVideogames,
        videogames,
        fetchVideogames,
        videogame,
        fetchVideogame,
        consoles,
        fetchConsoles,
        genres,
        fetchGenres,
        pegis,
        fetchPegis,
        isLoading,
        fileUrl
    }

    return (

        <GlobalContext.Provider value={data}>
            {children}
        </GlobalContext.Provider>
    )
}


function useGlobalContext() {
    const context = useContext(GlobalContext);
    if (!context) {
        throw new Error("useGlobalContext is not inside the context provider GlobalProvider");
    }
    return context;
}

export { GlobalProvider, useGlobalContext };