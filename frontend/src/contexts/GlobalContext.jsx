// Creazione della GlobalContext che conterrà tutte le chiamate API al server
import { createContext, useContext, useState } from "react";
import axios from "axios";

//crea il Context e gli do il nome GlobalContext

const GlobalContext = createContext();


// Creo il provider customizzato:
const GlobalProvider = ({ children }) => {

    // Variables

    const apiUrl = import.meta.env.VITE_API_URL;
    const fileUrl = import.meta.env.VITE_BACKEND_FILE_URL;

    // videogame

    const homepageEndpoint = "homepage";
    const [homepageVideogames, setHomeVideogames] = useState([]);

    const endpoint = "videogames/";
    const [videogames, setVideogames] = useState([]);

    const videogameEndpoint = `videogame/`;
    const [videogame, setVideogame] = useState({});

    const [isLoading, setIsLoading] = useState(true);

    // Functions

    const fetchHomepageVideogames = () => {
        axios.get(apiUrl + endpoint + homepageEndpoint).then((res) => {
            setIsLoading(false);
            console.log(res.data);
            const latestFour = res.data.items;
            setHomeVideogames(latestFour);
        })
    }

    const fetchVideogames = () => {
        axios.get(apiUrl + endpoint).then((res) => {
            setIsLoading(false);
            console.log(res.data.items.data);
            const videogames = res.data.items.data;
            setVideogames(videogames);

        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata effettuata", videogames);
        });
    };

    const fetchVideogame = (slug) => {
        axios.get(apiUrl + videogameEndpoint + slug).then((res) => {
            setIsLoading(false);
            console.log(res.data.data.consoles);
            setVideogame(res.data.data)
        }).catch((err) => {
            console.log(err);
        })
    }

    const data = {
        homepageVideogames,
        fetchHomepageVideogames,
        videogames,
        fetchVideogames,
        videogame,
        fetchVideogame,
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