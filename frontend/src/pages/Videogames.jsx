import { useEffect } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Card from '../components/filter-page/Card';
import Paginator from '../components/filter-page/Paginator';
import Loader from '../components/general/Loader';
import mobileStyles from '../style/FilterMobile.module.css';

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
    setSearch,
    page,
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
    isLoading,
    resetSelectedFilters,
    initialLoader,
    setInitialLoader,
    isFilterOpen,
    toggleFilters,
    closeFilters,
    scrollTop,
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
  }, [searchParams]);

  useEffect(() => {
    setInitialLoader(true);
    scrollTop();
  }, []);

  return (
    <section id="videogames">
      {initialLoader ? (
        <Loader />
      ) : (
        <div id="filters" className="container">
          <div className="row">
            {/* // FILTER MENU */}

            <div
              className="col-4 d-none d-lg-block gap-3 form-check"
              style={{ minHeight: '100vh' }}
            >
              <div className="container p-3">
                <div className="row items-filters">
                  <h5 className="fw-bold">Filtra per console</h5>
                  {consoles.map((console) => {
                    return (
                      <div
                        key={console.id}
                        className="col-6 g-3 d-flex align-items-center gap-2"
                      >
                        <input
                          type="checkbox"
                          name="consoles[]"
                          id={`console-${console.id}`}
                          value={console.name}
                          checked={selectedConsoles.includes(console.name)}
                          onChange={handleConsolesChange}
                        />
                        <label htmlFor={`console-${console.id}`}>
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
                        key={genre.id}
                        className="col-6 g-3 d-flex align-items-center gap-2"
                      >
                        <input
                          type="checkbox"
                          name="genres[]"
                          id={`genre-${genre.id}`}
                          value={genre.name}
                          checked={selectedGenres.includes(genre.name)}
                          onChange={handleGenresChange}
                        />
                        <label htmlFor={`genre-${genre.id}`}>
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
                        key={pegi.id}
                        className="col-6 g-3 d-flex align-items-center gap-2"
                      >
                        <input
                          type="checkbox"
                          name="pegis[]"
                          id={`pegi-${pegi.id}`}
                          value={pegi.age}
                          checked={selectedPegis.includes(pegi.age.toString())}
                          onChange={handlePegisChange}
                        />
                        <label htmlFor={`pegi-${pegi.id}`}>{pegi.age}</label>
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

            {/* FILTER MENU MOBILE */}

            <div
              className={`${mobileStyles.mobileFilter} d-lg-none ${isFilterOpen ? mobileStyles.open : ''}`}
            >
              <div className="d-flex justify-content-end">
                <button
                  className={`btn btn-outline-secondary`}
                  onClick={closeFilters}
                >
                  ✖
                </button>
              </div>
              {/* CONSOLES */}

              <div className="container p-3">
                <div className={`row`}>
                  <h5 className="fw-bold">Filtra per console</h5>
                  {consoles.map((console) => (
                    <div
                      key={console.id}
                      className="col-12 col-md-4 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        type="checkbox"
                        name="consoles[]"
                        id={`console-mobile-${console.id}`}
                        value={console.name}
                        checked={selectedConsoles.includes(console.name)}
                        onChange={handleConsolesChange}
                      />
                      <label htmlFor={`console-mobile-${console.id}`}>
                        {console.name}
                      </label>
                    </div>
                  ))}
                </div>
              </div>

              {/* GENRES */}

              <div className="container p-3">
                <div className={`row`}>
                  <h5 className="fw-bold">Filtra per PEGI</h5>
                  {genres.map((genre) => (
                    <div
                      key={genre.id}
                      className="col-12 col-md-4 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        type="checkbox"
                        name="genres[]"
                        id={`genre-mobile-${genre.id}`}
                        value={genre.name}
                        checked={selectedGenres.includes(genre.name)}
                        onChange={handleGenresChange}
                      />
                      <label htmlFor={`genre-mobile-${genre.id}`}>
                        {genre.name}
                      </label>
                    </div>
                  ))}
                </div>
              </div>

              {/* PEGI */}

              <div className="container p-3">
                <div className={`row`}>
                  <h5 className="fw-bold">Filtra per PEGI</h5>
                  {pegis.map((pegi) => (
                    <div
                      key={pegi.id}
                      className="col-12 col-md-4 g-3 d-flex align-items-center gap-2"
                    >
                      <input
                        type="checkbox"
                        name="pegis[]"
                        id={`pegi-mobile-${pegi.id}`}
                        value={pegi.age}
                        checked={selectedPegis.includes(pegi.age.toString())}
                        onChange={handlePegisChange}
                      />
                      <label htmlFor={`pegi-mobile-${pegi.id}`}>
                        {pegi.age}
                      </label>
                    </div>
                  ))}
                </div>
                <div className="d-flex justify-content-end justify-content-md-star gap-3 mt-3 mt-md-5">
                  <button
                    className="btn btn-outline-secondary d-md-none"
                    onClick={closeFilters}
                  >
                    Chiudi
                  </button>

                  {pegis && (
                    <button
                      className="btn btn-danger me-md-5"
                      onClick={resetSelectedFilters}
                    >
                      Reset
                    </button>
                  )}
                </div>
              </div>
            </div>

            <div className="col">
              {isLoading ? (
                <Loader />
              ) : (
                <>
                  <div className="container">
                    <div className="d-flex align-items-center justify-content-center gap-1">
                      <div>
                        <button
                          className="btn btn-outline-secondary d-lg-none me-2"
                          onClick={toggleFilters}
                        >
                          <i className="fa-solid fa-filter"></i>
                        </button>
                      </div>
                      <h2 className="mb-0">
                        Lista videogiochi:
                        <span className="fw-bold text-primary ms-2">
                          {totalVideogames}
                        </span>
                      </h2>
                    </div>
                    <div className="row">
                      {videogames.length > 0 ? (
                        videogames.map((videogame) => (
                          <div
                            key={videogame.id}
                            className="col-12 col-md-6 col-lg-3 g-3"
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
                <Paginator currentPage={page} pagination={pagination} />
              )}
            </div>
          </div>
        </div>
      )}
    </section>
  );
}
