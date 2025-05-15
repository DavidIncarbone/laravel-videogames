import { useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useGlobalContext } from '../../contexts/GlobalContext';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import styles from '../../style/Slider.module.css';

const Slider = ({ data }) => {
  const {
    fileUrl,
    sliderRef,
    canScrollLeft,
    canScrollRight,
    checkScroll,
    scrollLeft,
    scrollRight,
  } = useGlobalContext();

  useEffect(() => {
    const el = sliderRef.current;
    if (!el) return;

    const handleScroll = () => checkScroll();

    setTimeout(() => {
      checkScroll();
    }, 1000);

    el.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', handleScroll);

    return () => {
      el.removeEventListener('scroll', handleScroll);
      window.removeEventListener('resize', handleScroll);
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
