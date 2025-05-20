import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';
import { useGlobalContext } from './GlobalContext';

const FilterContext = createContext();

const FilterProvider = ({ children }) => {
  // ***** VARIABLES *****

  const { setInitialLoader, startLoading, stopLoading, apiUrl } =
    useGlobalContext();

  // GLOBAL SEARCH
  const [search, setSearch] = useState('');

  // ALL ENTITIES
  const endpoint = 'videogames';
  const [videogames, setVideogames] = useState([]);
  const [totalVideogames, setTotalVideogames] = useState(0);
  const [consoles, setConsoles] = useState([]);
  const [genres, setGenres] = useState([]);
  const [pegis, setPegis] = useState([]);

  // QUERY STRING
  const [searchParams, setSearchParams] = useSearchParams();
  let newParams = new URLSearchParams(searchParams);

  // FILTERS
  const [selectedConsoles, setSelectedConsoles] = useState([]);
  const [selectedGenres, setSelectedGenres] = useState([]);
  const [selectedPegis, setSelectedPegis] = useState([]);

  // MOBILE FILTER MENU
  const [isFilterOpen, setFilterOpen] = useState(false);

  // EXCEPTION
  const [pagination, setPagination] = useState({});
  const [page, setPage] = useState(+searchParams.get('page') || '');

  //   ***** FUNCTIONS *****

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
        const videogamesPagination = items?.videogames || {};
        const videogamesData = items?.videogames?.data || [];
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

  // CHECKBOX FILTERS
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

  const data = {
    // GLOBAL SEARCH
    search,
    setSearch,

    // ALL ENTITIES
    fetchVideogames,
    totalVideogames,
    videogames,
    consoles,
    genres,
    pegis,

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

    // EXCEPTION
    pagination,
    setPagination,
    page,
    setPage,
  };

  return (
    <FilterContext.Provider value={data}>{children}</FilterContext.Provider>
  );
};

function useFilterContext() {
  const context = useContext(FilterContext);
  if (!context) {
    throw new Error(
      'useFilterContext is not inside the context provider FilterProvider',
    );
  }
  return context;
}

export { FilterProvider, useFilterContext };
