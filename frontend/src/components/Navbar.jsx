import styles from "../style/videogameDetails.module.css";
import { NavLink } from 'react-router-dom';

export default function Navbar() {
    return (
        <nav className={`navbar navbar-expand-lg navbar-dark bg-dark ${styles.navbar}`}>
            <div className="container-fluid">
                <NavLink to="/" className="text-decoration-none text-white">Ultimi videogiochi</NavLink>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item d-flex align-items-center gap-2">
                            <i className="fa-solid fa-list text-white"></i>
                            <NavLink to="/videogames" className="text-decoration-none text-white">Tutti i videogiochi</NavLink>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    )
}