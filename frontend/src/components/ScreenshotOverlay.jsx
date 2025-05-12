
import styles from '../style/Overlay.module.css';

const ScreenshotOverlay = ({title, src, alt, handleScreenshotOverlayClick, prev, next, currentIndex, length}) => {

    return (
        
    <div className={`${styles.overlay}`} onClick={handleScreenshotOverlayClick}>
        <h3 className='text-white text-center mb-3'>Screenshot di <span className="fw-bold text-primary">{title}</span></h3>
        
        <div className={`d-flex align-items-center gap-3 text-white fs-1`}>
            <div> 
                <i id="arrow-left-current" className={`fa-solid fa-circle-left ${styles.arrorLeftCurrent}`} onClick={prev}></i>
            </div>
            <div className={`${styles.overlayScreenshotContainer}`}>
                <img src={src} alt={alt} />
            </div>
            <div>
                <i className={`fa-solid fa-circle-right ${styles.arrorRightCurrent}`} onClick={next}></i>
            </div>

        </div>
       
        <div className="text-white mt-3">{currentIndex} di {length}</div>
    </div>
        
    )
};

export default ScreenshotOverlay;