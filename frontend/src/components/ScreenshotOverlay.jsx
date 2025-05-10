
import styles from '../style/Overlay.module.css';

const ScreenshotOverlay = ({title, src, alt, handleScreenshotOverlayClick, prev, next, currentIndex, length}) => {

    return (
        
    <div className={`${styles.overlay} debug `} onClick={handleScreenshotOverlayClick}>
        <h3 className='text-white mb-3'>Screenshot di <span className="fw-bold text-primary">{title}</span></h3>
        <div className={`${styles.overlayScreenshotContainer} d-flex align-items-center gap-3 text-white fs-1`}>
            <div>
                <i id="arrow-left-current" className={`fa-solid fa-circle-left ${styles.arrorLeftCurrent}`} onClick={prev}></i>
            </div>
            <img src={src} alt={alt} />
            <div>
                <i className={`fa-solid fa-circle-right ${styles.arrorRightCurrent}`} onClick={next}></i>
            </div>
        </div>
        <div className="text-white mt-3">{currentIndex} di {length}</div>
    </div>
        
    )
};

export default ScreenshotOverlay;