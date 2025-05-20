import { useEffect } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import { useFilterContext } from '../contexts/FilterContext';
import Loader from '../components/general/Loader';
import Carousel from '../components/homepage/Carousel';
import Slider from '../components/homepage/Slider';

export default function HomePage() {
  // Dichiarazione variabili
  const { homepageVideogames, fetchHomepageVideogames, fileUrl, isLoading } =
    useGlobalContext();

  const { consoles, genres, fetchVideogames, resetFilters } =
    useFilterContext();

  // Dichiarazione funzioni
  useEffect(() => {
    fetchHomepageVideogames();
    fetchVideogames();
  }, []);

  return (
    <>
      {isLoading ? (
        <Loader />
      ) : (
        <>
          <section id="videogames" className="mb-5">
            <div className="container">
              <h2 className="text-center mb-4 fw-bold">Ultime novità</h2>
              <Carousel data={homepageVideogames} fileUrl={fileUrl} />
            </div>
          </section>

          <section className="my-5">
            <>
              <h2 className="text-center fw-bold mb-3">
                Seleziona per console
              </h2>
              <div className="position-relative">
                <Slider data={consoles} urlKey={'consoles'} />
              </div>
            </>
          </section>

          <section className="my-5">
            <h2 className="text-center fw-bold mb-3">Seleziona per genere</h2>
            <div className="position-relative">
              <Slider
                data={genres}
                urlKey={'genres'}
                resetFilters={resetFilters}
              />
            </div>
          </section>
        </>
      )}
    </>
  );
}
