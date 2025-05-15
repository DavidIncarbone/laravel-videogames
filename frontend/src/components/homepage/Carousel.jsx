import { useEffect } from 'react';
import { NavLink } from 'react-router-dom';
import { useGlobalContext } from '../../contexts/GlobalContext';
import { Container } from 'react-bootstrap';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import styles from '../../style/Carousel.module.css';

const Carousel = ({ data, fileUrl }) => {
  const {
    activeIndex,
    startAutoSlide,
    stopAutoSlide,
    goToPrev,
    goToNext,
    handleDotClick,
  } = useGlobalContext();

  useEffect(() => {
    startAutoSlide();
    return () => stopAutoSlide();
  }, [data.length]);

  return (
    <Container>
      <div
        className={styles.sliderContainer}
        onMouseEnter={stopAutoSlide}
        onMouseLeave={startAutoSlide}
      >
        <div
          className={styles.sliderTrack}
          style={{ transform: `translateX(-${activeIndex * 100}%)` }}
        >
          {data.map((item) => {
            return (
              <div key={item.id} className={styles.slide}>
                <NavLink to={`/videogame/${item.slug}`}>
                  <img
                    src={`${fileUrl}${item.screenshots.length > 0 ? item.screenshots[0].url : item.placeholder} `}
                    alt={item.name}
                  />
                </NavLink>
                <div className={styles.overlay}>
                  <h2>{item.name}</h2>
                  <p>{item.description}</p>
                </div>
              </div>
            );
          })}
        </div>

        <button className={styles.arrowLeft} onClick={goToPrev}>
          <FaChevronLeft />
        </button>
        <button className={styles.arrowRight} onClick={goToNext}>
          <FaChevronRight />
        </button>
      </div>

      <div className={styles.dotsWrapper}>
        {data.map((_, index) => (
          <span
            key={index}
            className={`${styles.dot} ${index === activeIndex ? styles.activeDot : ''}`}
            onClick={() => handleDotClick(index)}
          />
        ))}
      </div>
    </Container>
  );
};

export default Carousel;
