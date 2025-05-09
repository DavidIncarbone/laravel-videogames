import { useState, useEffect, useRef } from 'react';
import styles from '../style/Carousel.module.css';
import { Container } from 'react-bootstrap';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';

const Carousel = ({ data, fileUrl }) => {
    const [activeIndex, setActiveIndex] = useState(0);
    const intervalRef = useRef(null);

    const startAutoSlide = () => {
        if (!intervalRef.current) {
            intervalRef.current = setInterval(() => {
                setActiveIndex((prev) => (prev + 1) % data.length);
            }, 3000);
        }
    };

    const stopAutoSlide = () => {
        if (intervalRef.current) {
            clearInterval(intervalRef.current);
            intervalRef.current = null;
        }
    };

    useEffect(() => {
        startAutoSlide();
        return () => stopAutoSlide();
    }, [data.length]);

    const goToPrev = () => {
        setActiveIndex((prev) => (prev - 1 + data.length) % data.length);
    };

    const goToNext = () => {
        setActiveIndex((prev) => (prev + 1) % data.length);
    };

    const handleDotClick = (index) => {
        setActiveIndex(index);
    };

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
                    {data.map((item) => (
                        <div key={item.id} className={styles.slide}>
                            <img src={`${fileUrl}${item.screenshots[0].url}`} alt={item.name} />
                            <div className={styles.overlay}>
                                <h2>{item.name}</h2>
                                <p>{item.description}</p>
                            </div>
                        </div>
                    ))}
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
