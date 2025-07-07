import { useEffect } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import { useFilterContext } from '../contexts/FilterContext';
import { usePaginationContext } from '../contexts/PaginationContext';
import Paginator from '../components/filter-page/Paginator';
import Loader from '../components/general/Loader';
import FilterBlock from '../components/filter-page/FilterBlock';
import FilterBlockMobile from '../components/filter-page/FilterBlockMobile';
import CardList from '../components/filter-page/CardList';
import mobileStyles from '../style/FilterMobile.module.css';

export default function Videogames() {
  // VARIABLES

  const {
    // ENTITIES
    fetchVideogames,
    videogames,
    totalVideogames,
    consoles,
    genres,
    pegis,
    // SEARCH
    setSearch,
    // CHECKBOX
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
    // QUERY STRING
    searchParams,
    // MOBILE
    isFilterOpen,
    toggleFilters,
    closeFilters,
    // EXCEPTION
    pagination,
  } = useFilterContext();

  const { fileUrl, isLoading, initialLoader, setInitialLoader } =
    useGlobalContext();

  const { page, scrollTop, setPage } = usePaginationContext();

  // FUNCTIONS

  // useEffect(() => {
  //   window.scrollTo(0, 0);
  // }, []);

  useEffect(() => {
    const consolesUrl = searchParams.getAll('consoles[]');
    const genresUrl = searchParams.getAll('genres[]');
    const pegisUrl = searchParams.getAll('pegis[]');
    const search = searchParams.get('search');
    console.log(page);
    setSelectedConsoles(consolesUrl);
    setSelectedGenres(genresUrl);
    setSelectedPegis(pegisUrl);
    setSearch(search);
    fetchVideogames(search, page, consolesUrl, genresUrl, pegisUrl);
  }, [searchParams]);

  useEffect(() => {
    setInitialLoader(true);
    setPage(page && String(page).length ? page : 1);
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
              {/* // CONSOLE */}
              <FilterBlock
                data={consoles}
                title={'Filtra per console'}
                subject={'console'}
                selectedItems={selectedConsoles}
                handleItemsChange={handleConsolesChange}
              />

              {/* GENRES */}
              <FilterBlock
                data={genres}
                title={'Filtra per genere'}
                subject={'genre'}
                selectedItems={selectedGenres}
                handleItemsChange={handleGenresChange}
              />

              {/* PEGI */}
              <FilterBlock
                data={pegis}
                title={'Filtra per PEGI'}
                subject={'pegi'}
                selectedItems={selectedPegis}
                handleItemsChange={handlePegisChange}
              />

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
              <FilterBlockMobile
                data={consoles}
                title={'Filtra per console'}
                subject={'console'}
                selectedItems={selectedConsoles}
                handleItemsChange={handleConsolesChange}
              />

              {/* GENRES */}
              <FilterBlockMobile
                data={genres}
                title={'Filtra per genere'}
                subject={'genre'}
                selectedItems={selectedGenres}
                handleItemsChange={handleGenresChange}
              />

              {/* PEGI */}
              <FilterBlockMobile
                data={pegis}
                title={'Filtra per PEGI'}
                subject={'pegi'}
                selectedItems={selectedPegis}
                handleItemsChange={handlePegisChange}
              />
              <div className="d-flex justify-content-end justify-content-md-star gap-3 mt-3 mt-md-5">
                <button
                  className="btn btn-outline-secondary d-md-none"
                  onClick={closeFilters}
                >
                  Chiudi
                </button>

                <button
                  className="btn btn-danger me-md-5"
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
                  <CardList
                    toggleFilters={toggleFilters}
                    totalItems={totalVideogames}
                    title={'Lista Videogiochi'}
                    data={videogames}
                    fileUrl={fileUrl}
                  />
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
