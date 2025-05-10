// Creazione della GlobalContext che conterrà tutte le chiamate API al server
import { createContext, useContext, useState, useRef } from "react";
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

    const [loadingCount, setLoadingCount] = useState(0);

    // CONSOLE

    const consolesEndpoint = "consoles";
    const [consoles, setConsoles] = useState([]);

    // GENRES

    const genresEndpoint = "genres";
    const [genres, setGenres] = useState([]);

    // PEGI

    const pegisEndpoint = "pegis";
    const [pegis, setPegis] = useState([]);

    // OVERLAYS

    const [isCoverOverlayOpen, setCoverOverlayOpen] = useState(false);
    const [isScreenshotOverlayOpen, setScreenshotOverlayOpen] = useState(false);
    const [currentIndex, setCurrentIndex] = useState(0);


    //   ***** FUNCTIONS *****

    // LOADER

    const startLoading = () => setLoadingCount((count) => count + 1);
    const stopLoading = () => setLoadingCount((count) => count - 1);
    const isLoading = loadingCount > 0;

    // VIDEOGAMES

    const fetchHomepageVideogames = () => {
        startLoading();
        axios.get(apiUrl + endpoint + homepageEndpoint).then((res) => {
            console.log("ultimi 4 videogiochi", res.data);
            const latestFour = res.data.items;
            setHomeVideogames(latestFour);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata agli ultimi videogiochi effettuata");
            stopLoading();
        });
    }

    const fetchVideogames = () => {
        startLoading();
        axios.get(apiUrl + endpoint).then((res) => {
            console.log("videogiochi", res.data.items.data);
            const videogames = res.data.items.data;
            setVideogames(videogames);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai videogiochi effettuata");
            stopLoading();
        });
    };

    const fetchVideogame = (slug) => {
        startLoading();
        setVideogame({});
        axios.get(apiUrl + videogameEndpoint + slug).then((res) => {
            console.log("Videogioco attuale", res.data);
            const videogame = res.data.item;
            console.log("pegi del videogioco", videogame.pegi.age)
            setVideogame(videogame)
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log(`Chiamata al videogioco effettuata`);
            stopLoading();
        });
    }

    // CONSOLE

    const fetchConsoles = () => {
        startLoading();
        axios.get(apiUrl + consolesEndpoint).then((res) => {
            console.log("console", res.data);
            const consoles = res.data.items;
            setConsoles(consoles);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata alle Console effettuata");
            stopLoading();
        });
    }

    // GENRES

    const fetchGenres = () => {
        startLoading();
        axios.get(apiUrl + genresEndpoint).then((res) => {
            
            console.log("generi", res.data);
            const genres = res.data.items;
            setGenres(genres);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai Generi effettuata");
            stopLoading();
        });
    }

    // PEGI

    const fetchPegis = () => {
        startLoading();
        axios.get(apiUrl + pegisEndpoint).then((res) => {
            console.log("PEGI", res.data);
            const pegis = res.data.items;
            setPegis(pegis);
        }).catch((err) => {
            console.log(err);
        }).finally(() => {
            console.log("Chiamata ai PEGI effettuata");
            stopLoading();
        });
    }

    // CAROUSEL

    const [activeIndex, setActiveIndex] = useState(0);
    const intervalRef = useRef(null);

    const startAutoSlide = () => {
        if (!intervalRef.current) {
            intervalRef.current = setInterval(() => {
                setActiveIndex((prev) => (prev + 1) % homepageVideogames.length);
            }, 3000);
        }
    };

    const stopAutoSlide = () => {
        if (intervalRef.current) {
            clearInterval(intervalRef.current);
            intervalRef.current = null;
        }
    };

    const goToPrev = () => {
        setActiveIndex((prev) => (prev - 1 + homepageVideogames.length) % homepageVideogames.length);
    };

    const goToNext = () => {
        setActiveIndex((prev) => (prev + 1) % homepageVideogames.length);
    };

    const handleDotClick = (index) => {
        setActiveIndex(index);
    };

    // ** OVERLAYS SLIDER **

      //COVER
    
      const handleCoverClick = () => {
        setCoverOverlayOpen(true);
    };
    
    const handleCoverOverlayClick = () => {
        setCoverOverlayOpen(false);
    }

    // SCREENSHOT

    const handleScreenshotClick = (index) => {
        setCurrentIndex(index);
        setScreenshotOverlayOpen(true);

    };

    const handleScreenshotOverlayClick = () => {
        setScreenshotOverlayOpen(false);
    }

    const goToPrevSlide = (e) => {
        e.stopPropagation();
        setCurrentIndex((prev) => (prev - 1 + videogame.screenshots.length) % videogame.screenshots.length);
      };
    
      const goToNextSlide = (e) => {
        e.stopPropagation();
        setCurrentIndex((prev) => (prev + 1) % videogame.screenshots.length);
      };

      // DATA

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
        fileUrl,
        activeIndex,
        setActiveIndex,
        startAutoSlide,
        stopAutoSlide,
        goToPrev,
        goToNext,
        handleDotClick,
        isCoverOverlayOpen, isScreenshotOverlayOpen, currentIndex, handleCoverClick, handleCoverOverlayClick, handleScreenshotClick, handleScreenshotOverlayClick, goToPrevSlide, goToNextSlide
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