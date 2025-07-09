import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';

const GlobalContext = createContext();

const GlobalProvider = ({ children }) => {
  // ***** VARIABLES *****

  // *** GENERAL ***

  // ENV

  const apiUrl = import.meta.env.VITE_API_URL;
  const fileUrl = import.meta.env.VITE_BACKEND_FILE_URL;

  // LOADER

  const [isLoading, setLoading] = useState(false);
  const [initialLoader, setInitialLoader] = useState(false);

  // *** HOMEPAGE ***

  // VARS

  const homepageEndpoint = 'videogames/homepage';
  const [homepageVideogames, setHomepageVideogames] = useState([]);
  const consolesEndpoint = 'consoles';
  const [consoles, setConsoles] = useState([]);
  const genresEndpoint = 'genres';
  const [genres, setGenres] = useState([]);
  //   ***** FUNCTIONS *****

  // *** GENERAL ***

  // LOADER

  const startLoading = () => setLoading(true);
  const stopLoading = () => setLoading(false);

  // *** HOMEPAGE***

  // GET NEW GAMES

  const fetchHomepageVideogames = () => {
    startLoading();
    axios
      .get(apiUrl + homepageEndpoint)
      .then((res) => {
        console.log('ultimi 4 videogiochi', res.data);
        const latestFour = res.data.items;
        setHomepageVideogames(latestFour);
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        console.log('Chiamata agli ultimi videogiochi effettuata');
        // stopLoading();
      });
  };

  // GET CONSOLES

  const fetchConsoles = () => {
    axios
      .get(apiUrl + consolesEndpoint)
      .then((res) => {
        console.log(res.data);
        const items = res.data.items || {};
        setConsoles(items || []);
      })
      .catch((err) => {
        console.err(err);
      })
      .finally(() => {
        console.log('Chiamata alle console effettuata');
        stopLoading();
      });
  };
  const fetchGenres = () => {
    axios
      .get(apiUrl + genresEndpoint)
      .then((res) => {
        console.log(res.data);
        const items = res.data.items || {};
        setGenres(items || []);
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        console.log('Chiamata alle console effettuata');
        stopLoading();
      });
  };

  // CAROUSEL

  const [activeIndex, setActiveIndex] = useState(0);
  const intervalRef = useRef(null);

  const startAutoSlide = () => {
    if (!intervalRef.current && homepageVideogames.length > 0) {
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
    setActiveIndex(
      (prev) =>
        (prev - 1 + homepageVideogames.length) % homepageVideogames.length,
    );
  };

  const goToNext = () => {
    setActiveIndex((prev) => (prev + 1) % homepageVideogames.length);
  };

  const handleDotClick = (index) => {
    setActiveIndex(index);
  };

  // DATA

  const data = {
    // *** GLOBAL ***
    // URL
    apiUrl,
    fileUrl,

    // LOADER
    isLoading,
    startLoading,
    stopLoading,
    initialLoader,
    setInitialLoader,

    // *** HOMEPAGE ***
    // NEW GAMES
    homepageVideogames,
    fetchHomepageVideogames,
    fetchConsoles,
    consoles,
    fetchGenres,
    genres,

    // CAROUSEL
    activeIndex,
    setActiveIndex,
    startAutoSlide,
    stopAutoSlide,
    goToPrev,
    goToNext,
    handleDotClick,
  };

  return (
    <GlobalContext.Provider value={data}>{children}</GlobalContext.Provider>
  );
};

function useGlobalContext() {
  const context = useContext(GlobalContext);
  if (!context) {
    throw new Error(
      'useGlobalContext is not inside the context provider GlobalProvider',
    );
  }
  return context;
}

export { GlobalProvider, useGlobalContext };
