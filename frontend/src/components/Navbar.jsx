import styles from "../style/videogameDetails.module.css";

export default function Navbar() {
    return (
        <nav className={`navbar navbar-expand-lg navbar-dark bg-dark ${styles.navbar}`}>
            <div className="container-fluid">
                <h2 className="text-white">Portfolio di David Incarbone</h2>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <a className="nav-link" href="/">videogiochi</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="http://127.0.0.1:8000">Pannello di controllo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    )
}