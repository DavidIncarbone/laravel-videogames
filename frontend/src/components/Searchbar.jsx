const Searchbar = () => {
    return (
        <div className="input-group align-items-start">
            <div className="form-outline" data-mdb-input-init>
                <input type="search" id="form1" className="form-control" placeholder="Cerca per nome" />
            </div>
            <button type="button" className="btn btn-dark" data-mdb-ripple-init>
                <i className="fas fa-search"></i>
            </button>
        </div>
    )
}

export default Searchbar;