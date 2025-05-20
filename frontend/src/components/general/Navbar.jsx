import styles from '../../style/videogameDetails.module.css';
import { NavLink } from 'react-router-dom';
import { useFilterContext } from '../../contexts/FilterContext';

export default function Navbar() {
  const { resetSelectedFilters } = useFilterContext();

  return (
    <nav
      className={`navbar navbar-expand-lg navbar-dark bg-dark ${styles.navbar}`}
    >
      <div className="container-fluid">
        <ul className="navbar-nav">
          <li className="nav-item d-flex align-items-center gap-2">
            <i className="fa-solid fa-list text-white"></i>
            <NavLink
              to="/videogames?page=1"
              className="text-decoration-none text-white"
              onClick={() => resetSelectedFilters()}
            >
              Tutti i videogiochi
            </NavLink>
          </li>
        </ul>
      </div>
    </nav>
  );
}
