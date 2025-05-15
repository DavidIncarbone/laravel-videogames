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

  // GLOBAL SEARCH

  const [search, setSearch] = useState('');

  // LOADER

  const [isLoading, setLoading] = useState(false);
  const [initialLoader, setInitialLoader] = useState(false);

  // *** HOMEPAGE ***

  // NEW GAMES CAROUSEL

  const homepageEndpoint = 'videogames/homepage';
  const [homepageVideogames, setHomepageVideogames] = useState([]);

  // CONSOLE SLIDER

  const sliderRef = useRef(null);
  const [canScrollLeft, setCanScrollLeft] = useState(false);
  const [canScrollRight, setCanScrollRight] = useState(false);

  // *** ALL VIDEOGAMES PAGE ***

  // ALL ENTITIES

  const endpoint = 'videogames';
  const [videogames, setVideogames] = useState([]);
  const [totalVideogames, setTotalVideogames] = useState(0);
  const [consoles, setConsoles] = useState([]);
  const [genres, setGenres] = useState([]);
  const [pegis, setPegis] = useState([]);

  // QUERY STRING

  const [searchParams, setSearchParams] = useSearchParams();
  const newParams = new URLSearchParams(searchParams);

  // FILTERS

  const [selectedConsoles, setSelectedConsoles] = useState([]);
  const [selectedGenres, setSelectedGenres] = useState([]);
  const [selectedPegis, setSelectedPegis] = useState([]);

  // MOBILE FILTER MENU

  const [isFilterOpen, setFilterOpen] = useState(false);

  // PAGINATION

  const [page, setPage] = useState(+searchParams.get('page') || '');
  const [pagination, setPagination] = useState({});
  // const [page, setCurrentPage] = useState(1);
  const [showInput, setShowInput] = useState(false);
  const [pageInput, setPageInput] = useState('');
  const totalPages = pagination.last_page;

  // *** SHOW PAGE ***

  const videogameEndpoint = `videogame/`;
  const [videogame, setVideogame] = useState({});

  // OVERLAYS

  const [isCoverOverlayOpen, setCoverOverlayOpen] = useState(false);
  const [isScreenshotOverlayOpen, setScreenshotOverlayOpen] = useState(false);
  const [currentIndex, setCurrentIndex] = useState(0);

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

  // CONSOLE SLIDER

  const checkScroll = () => {
    const el = sliderRef.current;
    if (!el) return;

    setCanScrollLeft(el.scrollLeft > 0);
    setCanScrollRight(el.scrollLeft + el.clientWidth < el.scrollWidth);
  };

  const scrollLeft = () => {
    if (sliderRef.current) {
      sliderRef.current?.scrollBy({ left: -150, behavior: 'smooth' });
    }
  };

  const scrollRight = () => {
    if (sliderRef.current) {
      sliderRef.current?.scrollBy({ left: 150, behavior: 'smooth' });
    }
  };

  // *** ALL VIDEOGAMES PAGE ***

  // GET ALL ENTITIES

  const fetchVideogames = (
    search,
    page,
    consoles = [],
    genres = [],
    pegis = [],
  ) => {
    startLoading();

    const params = {
      page,
      search,
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
        setInitialLoader(false);
      });
  };

  // FILTERS

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
    setSelectedList(newSelected);
    newParams.delete(key);
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

  // RESET FILTERS

  const resetFilters = () => {
    setSearch('');
    setPage(1);
    setVideogames([]);
    setConsoles([]);
    setGenres([]);
    setPegis([]);
  };

  const resetSelectedFilters = () => {
    setSearch('');
    setPage(1);
    setSelectedConsoles([]);
    setSelectedGenres([]);
    setSelectedPegis([]);
    fetchVideogames();
    setSearchParams('page=1');
  };

  // MOBILE FILTERS MENU

  const toggleFilters = () => setFilterOpen((prev) => !prev);
  const closeFilters = () => setFilterOpen(false);

  // REFRESH VIDEOGAMES (NO PARAMS)

  const fetchAllVideogames = (search, page) => {
    startLoading();
    const params = {
      page,
      search,
    };
    axios
      .get(`${apiUrl}${endpoint}`, { params })
      .then((res) => {
        const items = res.data.items || {};
        const videogamesPagination = items.videogames || {};
        const videogamesData = items.videogames?.data || [];
        console.log('Risposta videogiochi:', videogamesData);
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

  // PAGINATION

  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= pagination.last_page) {
      setPage(newPage);
      newParams.set('page', newPage);
      setSearchParams(newParams);
    }
  };

  function scrollTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  }

  const getPageNumbers = () => {
    let pages = [];

    if (totalPages <= 3) {
      // Se il numero di pagine è 3 o inferiore, mostra tutte le pagine
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      if (page === 1) {
        pages = [1, 2, 3, '...', totalPages];
      } else if (page === 2) {
        pages = [1, 2, 3, '...', totalPages];
      } else if (page === totalPages - 1) {
        pages = [1, '...', totalPages - 2, totalPages - 1, totalPages];
      } else if (page === totalPages) {
        pages = [1, '...', totalPages - 2, totalPages - 1, totalPages];
      } else if (page >= 3 && page < totalPages - 1) {
        pages = [1, '...', page - 1, page, page + 1, '...', totalPages];
      }
    }

    return pages;
  };

  const handlePageInputChange = (e) => {
    const value = e.target.value;
    if (value === '' || /^[1-9][0-9]*$/.test(value)) {
      setPageInput(value);
    }
  };

  const handlePageInputBlur = () => {
    if (
      pageInput &&
      Number(pageInput) >= 1 &&
      Number(pageInput) <= totalPages
    ) {
      handlePageChange(Number(pageInput));
    }
    setShowInput(false);
  };

  const handlePageInputKeyDown = (e) => {
    if (e.key === 'Enter' && pageInput) {
      const page = Number(pageInput);
      if (page >= 1 && page <= totalPages) {
        handlePageChange(page);
        scrollTop();
      }
      setShowInput(false);
    }
  };
  // *** SHOW PAGE ***

  // GET SINGLE GAME

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

  // * OVERLAYS SLIDER *

  // COVER

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
    // *** GLOBAL ***
    // URL
    apiUrl,
    fileUrl,
    endpoint,

    // LOADER
    isLoading,
    startLoading,
    stopLoading,
    initialLoader,
    setInitialLoader,

    // GLOBAL SEARCH
    search,
    setSearch,

    // *** HOMEPAGE ***
    // NEW GAMES
    homepageVideogames,
    fetchHomepageVideogames,

    // CAROUSEL
    activeIndex,
    setActiveIndex,
    startAutoSlide,
    stopAutoSlide,
    goToPrev,
    goToNext,
    handleDotClick,

    // CONSOLE SLIDER
    sliderRef,
    canScrollLeft,
    setCanScrollLeft,
    canScrollRight,
    setCanScrollRight,
    checkScroll,
    scrollLeft,
    scrollRight,

    // *** ALL VIDEOGAMES PAGE ***
    // ALL ENTITIES
    fetchVideogames,
    totalVideogames,
    videogames,
    consoles,
    genres,
    pegis,
    fetchAllVideogames /* Refresh to initial state */,

    // FILTERS
    selectedConsoles,
    setSelectedConsoles,
    selectedGenres,
    setSelectedGenres,
    selectedPegis,
    setSelectedPegis,
    handleConsolesChange,
    handleGenresChange,
    handlePegisChange,
    resetSelectedFilters,

    // FILTERS MOBILE MENU
    isFilterOpen,
    setFilterOpen,
    toggleFilters,
    closeFilters,

    // QUERY STRING
    searchParams,
    setSearchParams,
    newParams,

    // PAGINATION
    page,
    setPage,
    page,
    pagination,
    handlePageChange,
    showInput,
    setShowInput,
    pageInput,
    setPageInput,
    totalPages,
    scrollTop,
    getPageNumbers,
    handlePageInputChange,
    handlePageInputBlur,
    handlePageInputKeyDown,

    // *** SHOW PAGE ***
    // VIDEOGAME
    fetchVideogame,
    videogame,

    // * OVERLAYS *
    // COVER
    isCoverOverlayOpen,
    handleCoverClick,
    handleCoverOverlayClick,

    // SCREENSHOT
    isScreenshotOverlayOpen,
    currentIndex,
    handleScreenshotClick,
    handleScreenshotOverlayClick,
    goToPrevSlide,
    goToNextSlide,
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
