import { useFilterContext } from '../../contexts/FilterContext';
import { usePaginationContext } from '../../contexts/PaginationContext';
import { useNavigate } from 'react-router-dom';

const Searchbar = () => {
  const { search, setSearch, newParams } = useFilterContext();
  const { setPage } = usePaginationContext();

  const navigate = useNavigate();

  const filteredVideogames = () => {
    newParams.set('search', search.trim().replace(/\s{2,}/g, ' '));
    newParams.set('page', 1);
    setPage(1);
    // fetchVideogames(search, 1, selectedConsoles, selectedGenres, selectedPegis);
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
