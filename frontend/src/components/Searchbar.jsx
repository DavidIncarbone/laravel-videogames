import { useGlobalContext } from '../contexts/GlobalContext';
import { useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';

const Searchbar = () => {
  const {
    search,
    setSearch,
    page,
    setPage,
    fetchVideogames,
    fetchAllVideogames,
    newParams,
    selectedConsoles,
    selectedGenres,
    selectedPegis,
    toggleFilters,
  } = useGlobalContext();

  const navigate = useNavigate();
  const location = useLocation();
  const isVideogamesPage = location.pathname.startsWith('/videogames');

  const filteredVideogames = () => {
    newParams.set('search', search.trim().replace(/\s{2,}/g, ' '));
    newParams.set('page', 1);
    setPage(1);
    isVideogamesPage
      ? fetchVideogames(
          search,
          1,
          selectedConsoles,
          selectedGenres,
          selectedPegis,
        )
      : fetchAllVideogames(search, 1);
    navigate(`/videogames?${newParams.toString()}`);
  };

  const handleKeyDown = (e) => {
    if (e.key === 'Enter') {
      filteredVideogames();
    }
  };

  return (
    <>
      <div className="input-group align-items-start">
        <div className="form-outline" data-mdb-input-init>
          <input
            type="search"
            id="form1"
            value={search || ''}
            className="form-control"
            placeholder="Cerca per nome"
            onChange={(e) => setSearch(e.target.value)}
            onKeyDown={handleKeyDown}
          />
        </div>
        <button
          type="submit"
          className="btn btn-dark"
          data-mdb-ripple-init
          onClick={filteredVideogames}
        >
          <i className="fas fa-search"></i>
        </button>
      </div>
    </>
  );
};

export default Searchbar;
