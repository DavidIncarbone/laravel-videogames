import axios from 'axios';
import { useState, useEffect } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import { Link } from 'react-router-dom';
import Loader from '../components/Loader';
import Carousel from '../components/homepage/Carousel';
import Slider from '../components/homepage/Slider';
import styles from '../style/Slider.module.css';

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
      <section id="videogames" className="mb-5">
        {isLoading ? (
          <Loader />
        ) : (
          <div className="container">
            <h2 className="text-center mb-4 fw-bold">Ultime novità</h2>
            <Carousel data={homepageVideogames} fileUrl={fileUrl} />
          </div>
        )}
      </section>

      <section>
        <h2 className="text-center fw-bold">Seleziona per console</h2>
        <div className="position-relative">
          <Slider data={consoles} />
        </div>
      </section>
    </>
  );
}
