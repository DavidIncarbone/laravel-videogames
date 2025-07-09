import Header from '../components/general/Header';
import Footer from '../components/general/Footer';
import Navbar from '../components/general/Navbar';
import { Link } from 'react-router-dom';
import { FaVihara } from 'react-icons/fa';
import styles from '../style/NotFound.module.css';

// footer 10vh
// header 97,6px
// navbar 44,8px

export default function NotFound() {
  return (
    <>
      <Header />
      <Navbar />
      <div
        className={`d-flex flex-column align-items-center justify-content-center ${styles.notFound}`}
      >
        <div className="text-center">
          <h1 className="display-1 fw-bold text-danger">404</h1>
          <p className="fs-3">
            <span className="text-warning">Oops!</span> Pagina non trovata.
          </p>
          <p className="lead">
            La pagina che stai cercando non esiste o è stata rimossa.
          </p>
          <Link to="/" className="btn btn-warning btn-lg mt-3">
            Torna alla Home
          </Link>
        </div>
      </div>
      <Footer />
    </>
  );
}
