
import styles from '../style/Loader.module.css';

const Loader = () => {
    return (
        <div className={styles.loaderContainer}>
            <div className={`spinner-border ${styles.spinner}`} role="status">
                <span className="visually-hidden">Loading...</span>
            </div>
            <p className={styles.loadingText}>Caricamento in corso...</p>
        </div>
    );
};

export default Loader;
