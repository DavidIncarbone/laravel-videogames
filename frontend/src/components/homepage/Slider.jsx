import { useEffect, useState, useRef } from 'react';
import { Link } from 'react-router-dom';
import { useGlobalContext } from '../../contexts/GlobalContext';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import SkeletonImg from '../../components/general/SkeletonImg';
import styles from '../../style/Slider.module.css';

const Slider = ({ data, urlKey }) => {
  // VARIABLES

  const { fileUrl } = useGlobalContext();
  const sliderRef = useRef(null);
  const [canScrollLeft, setCanScrollLeft] = useState(false);
  const [canScrollRight, setCanScrollRight] = useState(false);

  // FUNCTIONS

  const checkScroll = () => {
    const el = sliderRef.current;
    if (!el) return;

    setCanScrollLeft(el.scrollLeft > 0);
    setCanScrollRight(el.scrollLeft + el.clientWidth < el.scrollWidth);
  };

  const scrollLeft = () => {
    if (sliderRef.current) {
      sliderRef.current?.scrollBy({ left: -150, behavior: 'smooth' });
    }
  };

  const scrollRight = () => {
    if (sliderRef.current) {
      sliderRef.current?.scrollBy({ left: 150, behavior: 'smooth' });
    }
  };

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
        {data.map((item) => {
          const itemParam = encodeURIComponent(item.name ?? item.age).replace(
            /%20/g,
            '+',
          );
          return (
            <Link
              to={`videogames?page=1&${urlKey}[]=${itemParam}`}
              key={item.id}
              className={styles.sliderItem}
            >
              {item.logo ? (
                <SkeletonImg
                  src={fileUrl + item.logo}
                  alt={item.name}
                  className={styles.sliderImage}
                />
              ) : (
                <div className="fw-bold d-flex justify-content-center align-items-center w-100 h-100 border border-3 border-white fs-5">
                  <div className="text-dark">{item.name}</div>
                </div>
              )}
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
