import { useGlobalContext } from '../contexts/GlobalContext';
import { useNavigate } from 'react-router-dom';

const Searchbar = () => {
  const { search, setSearch, fetchVideogames, currentPage, setCurrentPage } =
    useGlobalContext();

  const navigate = useNavigate();
  const filteredVideogames = () => {
    if (search) {
      navigate(`/videogames?page=1&search=${search}`);
      fetchVideogames(search);
    }
  };

  const handleKeyDown = (e) => {
    if (e.key === 'Enter') {
      filteredVideogames();
    }
  };

  return (
    <div className="input-group align-items-start">
      <div className="form-outline" data-mdb-input-init>
        <input
          type="search"
          id="form1"
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
  );
};

export default Searchbar;
