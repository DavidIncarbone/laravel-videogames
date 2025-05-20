import { useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useGlobalContext } from '../contexts/GlobalContext';
import { useShowContext } from '../contexts/ShowContext';
import Loader from '../components/general/Loader';
import CoverOverlay from '../components/details-page/CoverOverlay';
import ScreenshotOverlay from '../components/details-page/ScreenshotOverlay';
import SkeletonImg from '../components/general/SkeletonImg';

export default function VideogamePage() {
  // Dichiaro le variabili
  const {
    videogame,
    fetchVideogame,
    isCoverOverlayOpen,
    isScreenshotOverlayOpen,
    currentIndex,
    handleCoverClick,
    handleCoverOverlayClick,
    handleScreenshotClick,
    handleScreenshotOverlayClick,
    goToPrevSlide,
    goToNextSlide,
  } = useShowContext();

  const { fileUrl, isLoading } = useGlobalContext();

  const { slug } = useParams();
  console.log(slug);

  // Dichiaro le funzioni

  useEffect(() => {
    fetchVideogame(slug);
  }, [slug]);

  return (
    <>
      {/* OVERLAYS */}

      {isCoverOverlayOpen && (
        <CoverOverlay
          title={videogame.name}
          src={fileUrl + videogame.cover}
          alt={videogame.name}
          handleCoverOverlayClick={handleCoverOverlayClick}
        />
      )}

      {isScreenshotOverlayOpen && (
        <ScreenshotOverlay
          title={videogame.name}
          src={fileUrl + videogame.screenshots[currentIndex].url}
          alt={videogame.name}
          handleScreenshotOverlayClick={handleScreenshotOverlayClick}
          prev={goToPrevSlide}
          next={goToNextSlide}
          currentIndex={currentIndex + 1}
          length={videogame.screenshots.length}
        />
      )}

      {isLoading ? (
        <Loader />
      ) : (
        <div
          className="container px-3 px-lg-5 py-4 mb-3 position-relative"
          style={{ backgroundColor: '#EBEDEF' }}
        >
          {/* Header */}
          <div className="mb-4 text-center text-lg-start">
            <h1 className="fs-2">{videogame.name}</h1>
            <p className="text-muted">
              Esplora i dettagli completi del videogioco.
            </p>
          </div>

          {/*  Videogame Details  */}

          <section id="videogame-details">
            <div className="row gy-4">
              {/* Videogame Image and Description  */}

              <div className="col-12 col-lg-6">
                <div className=" mb-3" style={{ height: '50vh' }}>
                  <SkeletonImg
                    src={fileUrl + videogame.cover}
                    alt={videogame.name}
                    className={'rounded shadow-sm current-cover'}
                    objectFit={'contain'}
                    cursor={'zoom-in'}
                    onClick={handleCoverClick}
                  />
                </div>
                {videogame?.screenshots?.length > 0 ? (
                  <>
                    <h5 className="text-center mb-3">Screenshot allegati:</h5>
                    <div className="d-flex gap-3 mb-3">
                      {videogame.screenshots?.map((screenshot, index) => {
                        return (
                          <div
                            key={screenshot.id}
                            style={{ width: '144px', height: '62px' }}
                          >
                            <SkeletonImg
                              src={fileUrl + screenshot.url}
                              alt={videogame.name}
                              className="current-screenshot"
                              cursor={'zoom-in'}
                              onClick={() => handleScreenshotClick(index)}
                            />
                          </div>
                        );
                      })}
                    </div>
                  </>
                ) : (
                  <p className="fw-bold text-center">
                    Nessuno screenshot presente
                  </p>
                )}

                <h5>
                  <strong>Descrizione:</strong>
                </h5>
                <p>{videogame.description}</p>
              </div>

              {/* Videogame Info  */}

              <div className="col-12 col-lg-6">
                <div className="d-flex align-items-center gap-3 mb-4 flex-wrap">
                  <div style={{ width: '75px', height: '75px' }}>
                    <SkeletonImg
                      src={fileUrl + videogame.pegi?.logo}
                      alt={`PEGI` + videogame.pegi?.age}
                      className="img-fluid"
                    />
                  </div>
                  <div>
                    <div>
                      <strong>Casa produttrice:</strong> {videogame.publisher}
                    </div>
                    <div>
                      <strong>Anno di uscita:</strong>{' '}
                      {videogame.year_of_publication}
                    </div>
                  </div>
                </div>

                <div className="mb-3">
                  <p>
                    <strong>Disponibile per:</strong>
                  </p>
                  <ul className="list-unstyled d-flex flex-wrap gap-5">
                    {videogame.consoles?.map((console) => {
                      return (
                        <li
                          key={console.id}
                          style={{ width: '75px', height: '75px' }}
                          className=" d-flex align-items-center"
                        >
                          <SkeletonImg
                            src={fileUrl + console.logo}
                            alt={console.name}
                            className="img-fluid"
                          />
                        </li>
                      );
                    })}
                  </ul>
                </div>

                <div className="mb-3">
                  <p>
                    <strong>Genere:</strong>
                  </p>
                  <ul className="list-unstyled d-flex flex-wrap gap-2">
                    {videogame.genres?.map((genre, index) => {
                      if (index === videogame.genres.length - 1) {
                        return <li key={genre.id}>{genre.name}</li>;
                      }
                      return <li key={genre.id}>{genre.name} - </li>;
                    })}
                  </ul>
                </div>

                <div className="mb-3">
                  <p>
                    <strong>
                      Prezzo:{' '}
                      <span className="badge bg-primary p-2 fs-5">
                        {videogame.price} €
                      </span>
                    </strong>
                  </p>
                </div>
              </div>
            </div>
          </section>
        </div>
      )}
    </>
  );
}
