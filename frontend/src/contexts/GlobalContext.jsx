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

    const endpoint = "videogames";
    const [videogames, setvideogames] = useState([]);

    const videogameEndpoint = `videogame/`;
    const [videogame, setvideogame] = useState({});

    const [isLoading, setIsLoading] = useState(true);

    // Functions

    const fetchvideogames = () => {
        axios.get(apiUrl + endpoint).then((res) => {
            setIsLoading(false);
            console.log(res.data.data);
            setvideogames(res.data.data);

        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata effettuata", videogames);
        });
    };

    const fetchvideogame = (id) => {
        axios.get(apiUrl + videogameEndpoint + id).then((res) => {
            setIsLoading(false);
            console.log(res.data);
            setvideogame(res.data.data)
        }).catch((err) => {
            console.log(err);
        })
    }

    const data = {
        videogames,
        videogame,
        fetchvideogames,
        fetchvideogame,
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