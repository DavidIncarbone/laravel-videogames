import { useEffect, useState } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Card from '../components/Card';
import Paginator from '../components/Paginator';
import { useLocation, useNavigate, useSearchParams } from 'react-router-dom';

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
    setSearchParams,
    newParams,
  } = useGlobalContext();

  // const querySearch = new URLSearchParams(location.search);
  // const search = querySearch.get('search') || '';

  // const [page, setPage] = useState(1);

  // FUNCTIONS

  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= pagination.last_page) {
      setPage(newPage);
      newParams.set('page', newPage);
      setSearchParams(newParams);
    }
  };

  // // USE EFFECT PER SEARCHBAR GLOBALE

  // useEffect(() => {
  //   const newParams = new URLSearchParams(searchParams);

  //   if (!page || page < 1) {
  //     setPage(1);
  //     return;
  //   }

  //   if (page) {
  //     newParams.set('page', page);
  //   }

  //   if (search) {
  //     newParams.set('search', search);
  //   }

  //   navigate(`?${newParams.toString()}`, { replace: true });
  //   fetchVideogames(search, page);
  // }, [page, search]);

  // // USE EFFECT PER CONDIVISIONE LINK

  // useEffect(() => {
  //   const consolesFromUrl = searchParams.getAll('consoles[]');
  //   const genresFromUrl = searchParams.getAll('genres[]');
  //   const pegisFromUrl = searchParams.getAll('pegis[]');

  //   setSelectedConsoles(consolesFromUrl);
  //   setSelectedGenres(genresFromUrl);
  //   setSelectedPegis(pegisFromUrl);
  //   fetchVideogames(search, page);
  // }, []);

  // // USE EFFECT PER REFRESH VIDEOGIOCHI AL CARICAMENTE DEL COMPONENTE

  // useEffect(() => {
  //   if (
  //     !searchParams.has('consoles[]') &&
  //     !searchParams.has('genres[]') &&
  //     !searchParams.has('pegis[]') &&
  //     !searchParams.has('search')
  //   ) {
  //     setSelectedConsoles([]);
  //     setSelectedGenres([]);
  //     setSelectedPegis([]);
  //     setSearch('');
  //     // fetchAllVideogames('', 1);
  //   }
  // }, [searchParams]);

  useEffect(() => {
    const consoles = searchParams.getAll('consoles[]');
    const genres = searchParams.getAll('genres[]');
    const pegis = searchParams.getAll('pegis[]');
    const search = searchParams.get('search') || '';
    // const page = Number(searchParams.get('page')) || 1;

    setSelectedConsoles(consoles);
    setSelectedGenres(genres);
    setSelectedPegis(pegis);
    setSearch(search);
    // setPage(page);

    fetchVideogames(search, page, consoles, genres, pegis);
  }, [searchParams, page]);
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
              className="btn btn-primary mb-3"
              onClick={() =>
                fetchVideogames(search, page, consoles, genres, pegis)
              }
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
