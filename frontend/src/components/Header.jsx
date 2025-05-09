import Searchbar from './Searchbar';

function Header() {
    return (
        <header className="p-3 text-white bg-warning d-flex align-items-center justify-content-between">

            <h1>Videogames</h1>
            <div>
                <Searchbar />
            </div>

        </header>
    )
}

export default Header;