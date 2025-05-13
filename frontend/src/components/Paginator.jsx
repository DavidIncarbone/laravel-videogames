import { NavLink } from 'react-router-dom';

const Paginator = ({ pageChange, currentPage, pagination }) => {
  return (
    <nav
      aria-label="Page navigation example"
      className="d-flex justify-content-center my-3"
    >
      <ul className="pagination">
        <li className="page-item">
          <button
            className="page-link"
            onClick={() => pageChange(currentPage - 1)}
            disabled={!pagination.prev_page_url}
          >
            Previous
          </button>
        </li>
        {Array.from({ length: pagination.last_page }, (_, i) => i + 1).map(
          (page) => {
            return (
              <li key={crypto.randomUUID()} className="page-item">
                <button className="page-link" onClick={() => pageChange(page)}>
                  {page}
                </button>
              </li>
            );
          },
        )}
        <li className="page-item">
          <button
            className="page-link"
            onClick={() => pageChange(currentPage + 1)}
            disabled={!pagination.next_page_url}
          >
            Next
          </button>
        </li>
      </ul>
    </nav>
  );
};

export default Paginator;
