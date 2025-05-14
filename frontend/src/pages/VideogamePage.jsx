import axios from 'axios';
import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import styles from '../style/videogameDetails.module.css';
import { useGlobalContext } from '../contexts/GlobalContext';
import Loader from '../components/Loader';
import CoverOverlay from '../components/CoverOverlay';
import ScreenshotOverlay from '../components/ScreenshotOverlay';

export default function VideogamePage() {
  // Dichiaro le variabili

  const {
    videogame,
    fetchVideogame,
    fileUrl,
    isCoverOverlayOpen,
    isScreenshotOverlayOpen,
    currentIndex,
    handleCoverClick,
    handleCoverOverlayClick,
    handleScreenshotClick,
    handleScreenshotOverlayClick,
    goToPrevSlide,
    goToNextSlide,
    isLoading,
  } = useGlobalContext();

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
            <div className="d-flex justify-content-between">
              <h1 className="fs-2 text-center">{videogame.name}</h1>
            </div>
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
                  <img
                    src={fileUrl + videogame.cover}
                    alt={videogame.name}
                    className="rounded shadow-sm current-cover"
                    style={{ cursor: 'zoom-in', objectFit: 'contain' }}
                    onClick={handleCoverClick}
                  />
                </div>
                <h5 className="text-center mb-3">Screenshot allegati:</h5>
                <div className="d-flex gap-3 mb-3">
                  {videogame.screenshots?.map((screenshot, index) => {
                    return (
                      <div
                        key={screenshot.id}
                        style={{ width: '144px', height: '62px' }}
                      >
                        <img
                          src={fileUrl + screenshot.url}
                          alt={videogame.name}
                          className="current-screenshot"
                          style={{ cursor: 'zoom-in' }}
                          onClick={() => handleScreenshotClick(index)}
                        />
                      </div>
                    );
                  })}
                </div>
                <h5>
                  <strong>Descrizione:</strong>
                </h5>
                <p>{videogame.description}</p>
              </div>

              {/* Videogame Info  */}

              <div className="col-12 col-lg-6">
                <div className="d-flex align-items-center gap-3 mb-4 flex-wrap">
                  <div style={{ width: '75px', height: '75px' }}>
                    <img
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
                        >
                          <img
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
                  <ul className="list-unstyled d-flex flex-wrap gap-1">
                    {videogame.genres?.map((genre) => {
                      return <li key={genre.id}>{genre.name}</li>;
                    })}
                  </ul>
                </div>

                <div className="mb-3">
                  <p>
                    <strong>
                      Prezzo:{' '}
                      <span className="badge bg-primary p-2 fs-5">
                        {videogame.price}$
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
