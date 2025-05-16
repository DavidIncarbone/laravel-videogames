import styles from '../style/NotFound.module.css';
import Header from '../components/Header';
import Footer from '../components/Footer';
import Navbar from '../components/Navbar';

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
