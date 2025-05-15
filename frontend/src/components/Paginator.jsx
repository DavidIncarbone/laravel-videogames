import { useState } from 'react';
import styles from '../style/Paginator.module.css';

const Paginator = ({ pageChange, currentPage, pagination }) => {
  const [showInput, setShowInput] = useState(false);
  const [pageInput, setPageInput] = useState('');

  const totalPages = pagination.last_page;

  const getPageNumbers = () => {
    const current = currentPage;
    let pages = [];

    if (totalPages <= 3) {
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      if (current === 1 || current === 2) {
        pages = [1, 2, 3, '...', totalPages];
      } else if (current === totalPages || current === totalPages - 1) {
        pages = [1, '...', totalPages - 2, totalPages - 1, totalPages];
      } else if (current >= 3 && current < totalPages - 1) {
        pages = [
          1,
          '...',
          current - 1,
          current,
          current + 1,
          '...',
          totalPages,
        ];
      }
    }

    return pages;
  };

  const handlePageInputChange = (e) => {
    const value = e.target.value;
    if (value === '' || /^[1-9][0-9]*$/.test(value)) {
      setPageInput(value);
    }
  };

  const handlePageInputBlur = () => {
    if (
      pageInput &&
      Number(pageInput) >= 1 &&
      Number(pageInput) <= totalPages
    ) {
      pageChange(Number(pageInput));
    }
    setShowInput(false);
  };

  const handlePageInputKeyDown = (e) => {
    if (e.key === 'Enter' && pageInput) {
      const page = Number(pageInput);
      if (page >= 1 && page <= totalPages) {
        pageChange(page);
      }
      setShowInput(false);
    }
  };

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
            onClick={() => pageChange(currentPage - 1)}
            disabled={!pagination.prev_page_url}
          >
            Previous
          </button>
        </li>

        {/* Page numbers with ellipsis */}
        {getPageNumbers().map((item, index) => (
          <li key={index} className={styles.pageItem}>
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
                onClick={() => pageChange(item)}
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
