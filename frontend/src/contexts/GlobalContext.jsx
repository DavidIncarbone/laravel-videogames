// Creazione della GlobalContext che conterrà tutte le chiamate API al server
import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';

//creo il Context e gli do il nome GlobalContext

const GlobalContext = createContext();

// Creo il provider customizzato:
const GlobalProvider = ({ children }) => {
  // ***** VARIABLES *****

  // ENV

  const apiUrl = import.meta.env.VITE_API_URL;
  const fileUrl = import.meta.env.VITE_BACKEND_FILE_URL;

  // *** VIDEOGAMES ***

  // HOMEPAGE

  const homepageEndpoint = 'videogames/homepage';
  const [homepageVideogames, setHomepageVideogames] = useState([]);

  // VIDEOGAMES LIST

  const endpoint = 'videogames';
  const [videogames, setVideogames] = useState([]);
  const [totalVideogames, setTotalVideogames] = useState(0);

  // FILTER & QUERY STRING

  const [searchParams, setSearchParams] = useSearchParams();
  const newParams = new URLSearchParams(searchParams);

  const [selectedConsoles, setSelectedConsoles] = useState([]);
  const [selectedGenres, setSelectedGenres] = useState([]);
  const [selectedPegis, setSelectedPegis] = useState([]);

  // PAGINATION

  const [page, setPage] = useState(+searchParams.get('page') || '');
  const [pagination, setPagination] = useState({});
  const [currentPage, setCurrentPage] = useState(1);

  // SHOW

  const videogameEndpoint = `videogame/`;
  const [videogame, setVideogame] = useState({});

  // LOADER

  const [loadingCount, setLoadingCount] = useState(0);

  // CONSOLE

  const [consoles, setConsoles] = useState([]);

  // GENRES

  const [genres, setGenres] = useState([]);

  // PEGI

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

  // GLOBAL SEARCH

  const [search, setSearch] = useState('');

  // *** VIDEOGAMES ***

  // HOMEPAGE

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
        stopLoading();
      });
  };

  // VIDEOGAMES LIST

  const fetchVideogames = (
    query,
    page,
    consoles = [],
    genres = [],
    pegis = [],
  ) => {
    startLoading();

    const params = {
      page,
      search: query,
      consoles,
      genres,
      pegis,
    };
    axios
      .get(`${apiUrl}${endpoint}`, { params })
      .then((res) => {
        const items = res.data.items || {};
        const videogamesPagination = items.videogames || {};
        const videogamesData = items.videogames?.data || [];

        console.log('Risposta videogiochi:', videogamesData);

        // Imposta comunque lo stato, anche se vuoto

        if (items) {
          setVideogames(videogamesPagination.data || []);
          setTotalVideogames(videogamesPagination.total || 0);
          setPagination(
            {
              current_page: videogamesPagination.current_page,
              last_page: videogamesPagination.last_page,
              next_page_url: videogamesPagination.next_page_url,
              prev_page_url: videogamesPagination.prev_page_url,
            } || {},
          );
          setConsoles(items.consoles || []);
          setGenres(items.genres || []);
          setPegis(items.pegis || []);
        }
      })
      .catch((err) => {
        console.error('Errore nella fetch:', err);
        resetFilters();
      })
      .finally(() => {
        console.log('Chiamata ai videogiochi effettuata');
        stopLoading();
      });
  };

  // FILTER

  const handleCheckboxChange = (key, value, selectedList, setSelectedList) => {
    const newParams = new URLSearchParams(searchParams);
    let newSelected;
    newParams.set('page', 1);
    setSearchParams(newParams);
    setPage(1);

    if (selectedList.includes(value)) {
      newSelected = selectedList.filter((item) => item !== value);
    } else {
      newSelected = [...selectedList, value];
    }

    // Aggiorna lo stato React
    setSelectedList(newSelected);

    // Aggiorna i parametri della query string
    newParams.delete(key); // cancella tutte le voci con quel nome
    newSelected.forEach((val) => newParams.append(key, val));
    setSearchParams(newParams);
  };

  const handleConsolesChange = (e) => {
    handleCheckboxChange(
      e.target.name,
      e.target.value,
      selectedConsoles,
      setSelectedConsoles,
    );
  };

  const handleGenresChange = (e) => {
    handleCheckboxChange(
      e.target.name,
      e.target.value,
      selectedGenres,
      setSelectedGenres,
    );
  };

  const handlePegisChange = (e) => {
    console.log(typeof e.target.value);
    handleCheckboxChange(
      e.target.name,
      e.target.value,
      selectedPegis,
      setSelectedPegis,
    );
  };

  // const resetFilters = () => {
  //   setVideogames([]);
  //   setPagination({});
  //   setSelectedConsoles([]);
  //   setSelectedGenres([]);
  //   setSelectedPegis([]);
  // };

  // ALL

  const fetchAllVideogames = (query, page) => {
    startLoading();
    // resetFilters();

    const params = {
      page,
      search: query,
    };
    axios
      .get(`${apiUrl}${endpoint}`, { params })
      .then((res) => {
        const items = res.data.items || {};
        const videogamesPagination = items.videogames || {};
        const videogamesData = items.videogames?.data || [];

        console.log('Risposta videogiochi:', videogamesData);

        // Imposta comunque lo stato, anche se vuoto

        if (items) {
          setVideogames(videogamesPagination.data || []);
          setTotalVideogames(videogamesPagination.total || 0);
          setPagination(
            {
              current_page: videogamesPagination.current_page,
              last_page: videogamesPagination.last_page,
              next_page_url: videogamesPagination.next_page_url,
              prev_page_url: videogamesPagination.prev_page_url,
            } || {},
          );
          setConsoles(items.consoles || []);
          setGenres(items.genres || []);
          setPegis(items.pegis || []);
        }
      })
      .catch((err) => {
        console.error('Errore nella fetch:', err);
        resetFilters();
      })
      .finally(() => {
        console.log('Chiamata ai videogiochi effettuata');
        stopLoading();
      });
  };

  // SHOW

  const fetchVideogame = (slug) => {
    startLoading();
    setVideogame({});
    axios
      .get(apiUrl + videogameEndpoint + slug)
      .then((res) => {
        console.log('Videogioco attuale', res.data);
        const videogame = res.data.item;
        console.log('pegi del videogioco', videogame.pegi.age);
        setVideogame(videogame);
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        console.log(`Chiamata al videogioco effettuata`);
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

  // ** OVERLAYS SLIDER **

  //COVER

  const handleCoverClick = () => {
    setCoverOverlayOpen(true);
  };

  const handleCoverOverlayClick = () => {
    setCoverOverlayOpen(false);
  };

  // SCREENSHOT

  const handleScreenshotClick = (index) => {
    setCurrentIndex(index);
    setScreenshotOverlayOpen(true);
  };

  const handleScreenshotOverlayClick = () => {
    setScreenshotOverlayOpen(false);
  };

  const goToPrevSlide = (e) => {
    e.stopPropagation();
    setCurrentIndex(
      (prev) =>
        (prev - 1 + videogame.screenshots.length) %
        videogame.screenshots.length,
    );
  };

  const goToNextSlide = (e) => {
    e.stopPropagation();
    setCurrentIndex((prev) => (prev + 1) % videogame.screenshots.length);
  };

  // DATA

  const data = {
    apiUrl,
    endpoint,
    homepageVideogames,
    fetchHomepageVideogames,
    videogames,
    fetchVideogames,
    pagination,
    currentPage,
    setCurrentPage,
    totalVideogames,
    videogame,
    fetchVideogame,
    consoles,
    genres,
    pegis,
    selectedConsoles,
    setSelectedConsoles,
    selectedGenres,
    setSelectedGenres,
    selectedPegis,
    setSelectedPegis,
    handleConsolesChange,
    handleGenresChange,
    handlePegisChange,
    isLoading,
    fileUrl,
    activeIndex,
    setActiveIndex,
    startAutoSlide,
    stopAutoSlide,
    goToPrev,
    goToNext,
    handleDotClick,
    isCoverOverlayOpen,
    isScreenshotOverlayOpen,
    currentIndex,
    handleCoverClick,
    handleCoverOverlayClick,
    handleScreenshotClick,
    handleScreenshotOverlayClick,
    goToPrevSlide,
    goToNextSlide,
    search,
    setSearch,
    page,
    setPage,
    // resetFilters,
    fetchAllVideogames,
    searchParams,
    setSearchParams,
    newParams,
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
