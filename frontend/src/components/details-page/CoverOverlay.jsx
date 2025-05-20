import styles from '../../style/Overlay.module.css';

const CoverOverlay = ({ title, src, alt, handleCoverOverlayClick }) => {
  return (
    <>
      <div className={`${styles.overlay}`} onClick={handleCoverOverlayClick}>
        <h3 className="text-white mb-3">
          Cover di <span className="fw-bold text-primary">{title}</span>
        </h3>
        <div className={styles.overlayImgContainer}>
          <img src={src} alt={alt} />
        </div>
      </div>
    </>
  );
};

export default CoverOverlay;
