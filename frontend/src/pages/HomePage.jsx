import { useEffect } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Loader from '../components/general/Loader';
import Carousel from '../components/homepage/Carousel';
import Slider from '../components/homepage/Slider';

export default function HomePage() {
  // Dichiarazione variabili

  const {
    homepageVideogames,
    fetchHomepageVideogames,
    fetchVideogames,
    fileUrl,
    isLoading,
    consoles,
    genres,
  } = useGlobalContext();

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
              <Slider data={genres} urlKey={'genres'} />
            </div>
          </section>

          {/* <section className="my-5 d-block d-lg-none">
            <h2 className="text-center fw-bold mb-3">Seleziona per PEGI</h2>
            <div className="position-relative">
              <Slider data={pegis} urlKey={'pegis'} />
            </div>
          </section>

          <section className="my-5 d-none d-lg-block">
            <h2 className="text-center fw-bold mb-4">Seleziona per PEGI</h2>
            <div className="d-flex justify-content-around flex-wrap">
              {pegis.map((pegi) => (
                <Link
                  to={`videogames?page=1&pegis[]=${pegi.age}`}
                  key={pegi.id}
                  className={styles.sliderItem}
                  style={{ width: '110px', height: '110px' }}
                >
                  <SkeletonImg src={fileUrl + pegi.logo} alt={pegi.age} />
                </Link>
              ))}
            </div>
          </section> */}
        </>
      )}
    </>
  );
}
