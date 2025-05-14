import { useEffect, useState } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Card from '../components/Card';
import Paginator from '../components/Paginator';
import { useLocation, useNavigate, useSearchParams } from 'react-router-dom';
import Loader from '../components/Loader';

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
    search,
    setSearch,
    page,
    setPage,
    selectedConsoles,
    setSelectedConsoles,
    selectedGenres,
    setSelectedGenres,
    selectedPegis,
    setSelectedPegis,
    handleConsolesChange,
    handleGenresChange,
    handlePegisChange,
    searchParams,
    handlePageChange,
    isLoading,
    resetSelectedFilters,
    initialLoader,
    setInitialLoader,
  } = useGlobalContext();

  // FUNCTIONS

  useEffect(() => {
    const consolesUrl = searchParams.getAll('consoles[]');
    const genresUrl = searchParams.getAll('genres[]');
    const pegisUrl = searchParams.getAll('pegis[]');
    const search = searchParams.get('search');
    setSelectedConsoles(consolesUrl);
    setSelectedGenres(genresUrl);
    setSelectedPegis(pegisUrl);
    setSearch(search);
    fetchVideogames(search, page, consolesUrl, genresUrl, pegisUrl);
  }, [searchParams, page]);

  useEffect(() => {
    setInitialLoader(true);
  }, []);
  return (
    <section id="videogames">
      {initialLoader ? (
        <Loader />
      ) : (
        <div id="filters" className="container">
          <div className="row">
            <div className="col-4 gap-3 form-check">
              <div className="container p-3">
                <div className="row items-filters">
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
                <div className="row items-filters">
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
                <div className="row items-filters">
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
              <div className="d-flex justify-content-end me-3">
                <button
                  className="btn btn-danger mb-3"
                  onClick={resetSelectedFilters}
                >
                  Reset
                </button>
              </div>
            </div>

            <div className="col">
              {isLoading ? (
                <Loader />
              ) : (
                <>
                  <h2 className="text-center ">
                    Lista videogiochi:
                    <span className="fw-bold text-primary ms-2">
                      {totalVideogames}
                    </span>
                  </h2>
                  <div className="container">
                    <div className="row">
                      {videogames.length > 0 ? (
                        videogames.map((videogame) => (
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
                </>
              )}
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
      )}
    </section>
  );
}
