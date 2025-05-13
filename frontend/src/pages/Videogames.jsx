import { useEffect, useState } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Card from '../components/Card';
import Paginator from '../components/Paginator';
import { useLocation, useNavigate } from 'react-router-dom';
export default function Videogames() {
  // VARIABLES

  const {
    fileUrl,
    fetchVideogames,
    videogames,
    pagination,
    totalVideogames,
    consoles,
    genres,
    pegis,
    selectedConsoles,
    selectedGenres,
    selectedPegis,
    handleConsolesChange,
    handleGenresChange,
    handlePegisChange,
    fetchAllVideogames,
  } = useGlobalContext();

  const location = useLocation();
  const navigate = useNavigate();

  const queryParams = new URLSearchParams();

  const querySearch = new URLSearchParams(location.search);
  const search = querySearch.get('search') || '';
  const [page, setPage] = useState(+querySearch.get('page') || '');
  // const [page, setPage] = useState(1);

  // FUNCTIONS

  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= pagination.last_page) {
      setPage(newPage);
    }
  };

  useEffect(() => {
    if (!page || page < 1) {
      setPage(1);
      return;
    }
    if (page) {
      queryParams.set('page', page);
    }

    if (search) {
      queryParams.set('search', search);
    }

    navigate(`?${queryParams.toString()}`, { replace: true });
    fetchAllVideogames(search, page);
  }, [page]);

  return (
    <section id="videogames">
      <div className="container">
        <div className="row">
          <div className="col-4 gap-3 bg-white form-check">
            <div className="container p-3">
              <div className="row">
                <h5 className="fw-bold">Filtra per console</h5>
                {consoles.map((console) => {
                  return (
                    <div
                      key={self.crypto.randomUUID()}
                      className="col-6 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        key={self.crypto.randomUUID()}
                        type="checkbox"
                        name="consoles[]"
                        id={`console-${console.id}`}
                        value={console.name}
                        checked={selectedConsoles.includes(console.name)}
                        onChange={handleConsolesChange}
                      />
                      <label
                        key={self.crypto.randomUUID()}
                        htmlFor={`console-${console.id}`}
                      >
                        {console.name}
                      </label>
                    </div>
                  );
                })}
              </div>
            </div>
            <div className="container p-3">
              <div className="row">
                <h5 className="fw-bold">Filtra per genere</h5>
                {genres.map((genre) => {
                  return (
                    <div
                      key={self.crypto.randomUUID()}
                      className="col-6 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        key={self.crypto.randomUUID()}
                        type="checkbox"
                        name="genres[]"
                        id={`genre-${genre.id}`}
                        value={genre.name}
                        checked={selectedGenres.includes(genre.name)}
                        onChange={handleGenresChange}
                      />
                      <label
                        key={self.crypto.randomUUID()}
                        htmlFor={`genre-${genre.id}`}
                      >
                        {genre.name}
                      </label>
                    </div>
                  );
                })}
              </div>
            </div>
            <div className="container p-3">
              <div className="row">
                <h5 className="fw-bold">Filtra per PEGI</h5>
                {pegis.map((pegi) => {
                  return (
                    <div
                      key={self.crypto.randomUUID()}
                      className="col-6 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        key={self.crypto.randomUUID()}
                        type="checkbox"
                        name="pegis[]"
                        id={`pegi-${pegi.id}`}
                        value={pegi.age}
                        checked={selectedPegis.includes(pegi.age.toString())}
                        onChange={handlePegisChange}
                      />
                      <label
                        key={self.crypto.randomUUID()}
                        htmlFor={`pegi-${pegi.id}`}
                      >
                        {pegi.age}
                      </label>
                    </div>
                  );
                })}
              </div>
            </div>
            <button
              className="btn btn-primary"
              onClick={() => fetchVideogames(search)}
            >
              Filtra
            </button>
          </div>

          <div className="col">
            <h2 className="text-center mb-4">
              Lista videogiochi:
              <span className="fw-bold text-primary ms-2">
                {totalVideogames}
              </span>
            </h2>
            <div className="container">
              <div className="row">
                {videogames.length > 0 ? (
                  videogames?.map((videogame) => (
                    <div
                      key={self.crypto.randomUUID()}
                      className="col-12 col-lg-3 g-3"
                    >
                      <Card
                        data={videogame}
                        fileUrl={fileUrl}
                        key={videogame.id}
                      />
                    </div>
                  ))
                ) : (
                  <p className="fw-bold text-center">
                    Nessun videogioco soddisfa i requisiti di ricerca
                  </p>
                )}
              </div>
            </div>
            {pagination.last_page > 1 && (
              <Paginator
                pageChange={handlePageChange}
                currentPage={page}
                pagination={pagination}
              />
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
