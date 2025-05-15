import Searchbar from './Searchbar';
import { NavLink } from 'react-router-dom';

function Header() {
  return (
    <header className="p-3 text-white bg-warning d-flex flex-column flex-lg-row align-items-center justify-content-start justify-content-lg-between container-fluid">
      <NavLink to="/" className="text-decoration-none text-white">
        <h1 className="fw-bold text-dark-emphasis">
          Video<span className="text-danger">Games</span>.it
        </h1>
      </NavLink>
      <div>
        <Searchbar />
      </div>
    </header>
  );
}

export default Header;
