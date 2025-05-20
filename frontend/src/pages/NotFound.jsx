import styles from '../style/NotFound.module.css';
import Header from '../components/general/Header';
import Footer from '../components/general/Footer';
import Navbar from '../components/general/Navbar';

export default function NotFound() {
  return (
    <>
      <Header />
      <Navbar />
      <div className={styles.notFound}></div>
      <Footer />
    </>
  );
}
