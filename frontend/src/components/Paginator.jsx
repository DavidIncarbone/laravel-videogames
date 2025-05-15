import { useGlobalContext } from '../contexts/GlobalContext';
import styles from '../style/Paginator.module.css';

const Paginator = ({ currentPage, pagination }) => {
  const {
    showInput,
    setShowInput,
    pageInput,
    totalPages,
    scrollTop,
    getPageNumbers,
    handlePageChange,
    handlePageInputBlur,
    handlePageInputChange,
    handlePageInputKeyDown,
  } = useGlobalContext();

  return (
    <nav
      aria-label="Page navigation"
      className="d-flex justify-content-center my-3"
    >
      <ul className={`pagination ${styles.pagination}`}>
        {/* Previous */}
        <li className={styles.pageItem}>
          <button
            className={`${styles.pageLink} ${!pagination.prev_page_url ? styles.disabled : ''}`}
            onClick={() => {
              handlePageChange(currentPage - 1);
              scrollTop();
            }}
            disabled={!pagination.prev_page_url}
          >
            Previous
          </button>
        </li>

        {/* Page numbers with ellipsis */}
        {getPageNumbers().map((item, index) => (
          <li key={index} className={`${styles.pageItem}`}>
            {item === '...' ? (
              <button
                className={styles.pageLink}
                onClick={() => setShowInput(true)}
              >
                ...
              </button>
            ) : (
              <button
                className={`${styles.pageLink} ${item === currentPage ? styles.active : ''}`}
                onClick={() => {
                  handlePageChange(item);
                  scrollTop();
                }}
              >
                {item}
              </button>
            )}
          </li>
        ))}

        {/* Input page number when ... is clicked */}
        {showInput && (
          <li className={styles.pageItem}>
            <input
              type="number"
              className={styles.pageInput}
              value={pageInput}
              onChange={handlePageInputChange}
              onBlur={handlePageInputBlur}
              onKeyDown={handlePageInputKeyDown}
              placeholder="Page"
              min={1}
              max={totalPages}
              autoFocus
            />
          </li>
        )}

        {/* Next */}
        <li className={styles.pageItem}>
          <button
            className={`${styles.pageLink} ${!pagination.next_page_url ? styles.disabled : ''}`}
            onClick={() => {
              handlePageChange(currentPage + 1);
              scrollTop();
            }}
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
