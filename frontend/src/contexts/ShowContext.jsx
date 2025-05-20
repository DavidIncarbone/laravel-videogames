import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';
import { useGlobalContext } from './GlobalContext';

const ShowContext = createContext();

const ShowProvider = ({ children }) => {
  // ***** VARIABLES *****

  const { startLoading, stopLoading, apiUrl } = useGlobalContext();

  // *** SHOW PAGE ***
  const videogameEndpoint = `videogame/`;
  const [videogame, setVideogame] = useState({});

  // OVERLAYS
  const [isCoverOverlayOpen, setCoverOverlayOpen] = useState(false);
  const [isScreenshotOverlayOpen, setScreenshotOverlayOpen] = useState(false);
  const [currentIndex, setCurrentIndex] = useState(0);

  //   ***** FUNCTIONS *****

  // *** SHOW PAGE ***
  // GET SINGLE GAME
  const fetchVideogame = (slug) => {
    startLoading();
    setVideogame({});
    axios
      .get(apiUrl + videogameEndpoint + slug)
      .then((res) => {
        console.log('Videogioco attuale', res.data);
        const videogame = res.data.item;
        console.log('pegi del videogioco', videogame.pegi.age);
        setVideogame(videogame);
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        console.log(`Chiamata al videogioco effettuata`);
        stopLoading();
      });
  };

  // * OVERLAYS SLIDER *
  // COVER
  const handleCoverClick = () => {
    setCoverOverlayOpen(true);
  };

  const handleCoverOverlayClick = () => {
    setCoverOverlayOpen(false);
  };

  // SCREENSHOT
  const handleScreenshotClick = (index) => {
    setCurrentIndex(index);
    setScreenshotOverlayOpen(true);
  };

  const handleScreenshotOverlayClick = () => {
    setScreenshotOverlayOpen(false);
  };

  const goToPrevSlide = (e) => {
    e.stopPropagation();
    setCurrentIndex(
      (prev) =>
        (prev - 1 + videogame.screenshots.length) %
        videogame.screenshots.length,
    );
  };

  const goToNextSlide = (e) => {
    e.stopPropagation();
    setCurrentIndex((prev) => (prev + 1) % videogame.screenshots.length);
  };

  const data = {
    // *** SHOW PAGE ***
    // VIDEOGAME
    fetchVideogame,
    videogame,

    // * OVERLAYS *
    // COVER
    isCoverOverlayOpen,
    handleCoverClick,
    handleCoverOverlayClick,

    // SCREENSHOT
    isScreenshotOverlayOpen,
    currentIndex,
    handleScreenshotClick,
    handleScreenshotOverlayClick,
    goToPrevSlide,
    goToNextSlide,
  };

  return <ShowContext.Provider value={data}>{children}</ShowContext.Provider>;
};
function useShowContext() {
  const context = useContext(ShowContext);
  if (!context) {
    throw new Error(
      'useShowContext is not inside the context provider ShowProvider',
    );
  }
  return context;
}

export { ShowProvider, useShowContext };
