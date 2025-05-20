import { Outlet } from 'react-router-dom';
import Header from '../components/general/Header.jsx';
import Footer from '../components/general/Footer.jsx';
import Navbar from '../components/general/Navbar.jsx';

export default function DefaultLayout() {
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
