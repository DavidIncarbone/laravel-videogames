import Card from './Card';

const CardList = ({ toggleFilters, totalItems, title, data, fileUrl }) => {
  return (
    <div className="container">
      <div className="d-flex align-items-center justify-content-center gap-1">
        <div>
          <button
            className="btn btn-outline-secondary d-lg-none me-2"
            onClick={toggleFilters}
          >
            <i className="fa-solid fa-filter"></i>
          </button>
        </div>
        <h2 className="mb-0">
          {title}
          <span className="fw-bold text-primary ms-2">{totalItems}</span>
        </h2>
      </div>
      <div className="row">
        {data.length > 0 ? (
          data.map((item) => (
            <div key={item.id} className="col-12 col-md-6 col-lg-3 g-3">
              <Card data={item} fileUrl={fileUrl} key={item.id} />
            </div>
          ))
        ) : (
          <p className="fw-bold text-center">
            Nessun videogioco soddisfa i requisiti di ricerca
          </p>
        )}
      </div>
    </div>
  );
};

export default CardList;
