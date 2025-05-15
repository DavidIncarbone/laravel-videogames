import { useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useGlobalContext } from '../../contexts/GlobalContext';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import styles from '../../style/Slider.module.css';

const Slider = ({ data, fileUrl }) => {
  const {
    sliderRef,
    canScrollLeft,
    canScrollRight,
    checkScroll,
    scrollLeft,
    scrollRight,
  } = useGlobalContext();

  useEffect(() => {
    checkScroll();
    const el = sliderRef.current;
    if (!el) return;
    el.addEventListener('scroll', checkScroll);
    window.addEventListener('resize', checkScroll);
    return () => {
      el.removeEventListener('scroll', checkScroll);
      window.removeEventListener('resize', checkScroll);
    };
  }, []);

  return (
    <div className={styles.sliderContainer} ref={sliderRef}>
      <ul className={`${styles.sliderTrack} gap-5 `}>
        {data.map((console) => {
          const consoleParam = encodeURIComponent(console.name).replace(
            /%20/g,
            '+',
          );
          return (
            <Link
              to={`videogames?page=1&consoles[]=${consoleParam}`}
              key={console.id}
              className={styles.sliderItem}
            >
              <img
                src={fileUrl + console.logo}
                alt={console.name}
                className={styles.sliderImage}
              />
            </Link>
          );
        })}
        <button
          className={`${styles.arrowLeft} ${!canScrollLeft ? styles.disabled : ''}`}
          onClick={scrollLeft}
          disabled={!canScrollLeft}
        >
          <FaChevronLeft />
        </button>
        <button
          className={`${styles.arrowRight} ${!canScrollRight ? styles.disabled : ''}`}
          onClick={scrollRight}
          disabled={!canScrollRight}
        >
          <FaChevronRight />
        </button>
      </ul>
    </div>
  );
};

export default Slider;
