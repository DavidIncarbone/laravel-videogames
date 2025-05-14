import { Outlet } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';
import Navbar from '../components/Navbar.jsx';
import Loader from '../components/Loader.jsx';
import { useGlobalContext } from '../contexts/GlobalContext';

export default function DefaultLayout() {
  const { isLoading } = useGlobalContext();
  return (
    <>
      <Header />
      <Navbar />
      <main className="container my-3">
        <Outlet />
      </main>
      <Footer />
    </>
  );
}
