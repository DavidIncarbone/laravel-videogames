// ***** VARIABLES *****

import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';
import { useFilterContext } from './FilterContext';

const PaginationContext = createContext();

const PaginationProvider = ({ children }) => {
  const {
    newParams,
    searchParams,
    setSearchParams,
    pagination,
    setPagination,
    page,
    setPage,
  } = useFilterContext();
  // PAGINATION

  const [showInput, setShowInput] = useState(false);
  const [pageInput, setPageInput] = useState('');
  const totalPages = pagination.last_page;

  // ***** FUNCTIONS *****

  // PAGINATION
  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= pagination.last_page) {
      setPage(newPage);
      newParams.set('page', newPage);
      setSearchParams(newParams);
    }
  };

  function scrollTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  }

  const getPageNumbers = () => {
    let pages = [];

    if (totalPages <= 3) {
      // Se il numero di pagine è 3 o inferiore, mostra tutte le pagine
      for (let i = 1; i <= totalPages; i++) {
        pages.push(i);
      }
    } else {
      if (page === 1) {
        pages = [1, 2, 3, '...', totalPages];
      } else if (page === 2) {
        pages = [1, 2, 3, '...', totalPages];
      } else if (page === totalPages - 1) {
        pages = [1, '...', totalPages - 2, totalPages - 1, totalPages];
      } else if (page === totalPages) {
        pages = [1, '...', totalPages - 2, totalPages - 1, totalPages];
      } else if (page >= 3 && page < totalPages - 1) {
        pages = [1, '...', page - 1, page, page + 1, '...', totalPages];
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
      handlePageChange(Number(pageInput));
    }
    setShowInput(false);
  };

  const handlePageInputKeyDown = (e) => {
    if (e.key === 'Enter' && pageInput) {
      const page = Number(pageInput);
      if (page >= 1 && page <= totalPages) {
        handlePageChange(page);
        scrollTop();
      }
      setShowInput(false);
    }
  };

  const data = {
    // PAGINATION
    page,
    setPage,
    page,
    pagination,
    handlePageChange,
    showInput,
    setShowInput,
    pageInput,
    setPageInput,
    totalPages,
    scrollTop,
    getPageNumbers,
    handlePageInputChange,
    handlePageInputBlur,
    handlePageInputKeyDown,
  };

  return (
    <PaginationContext.Provider value={data}>
      {children}
    </PaginationContext.Provider>
  );
};

function usePaginationContext() {
  const context = useContext(PaginationContext);
  if (!context) {
    throw new Error(
      'usePaginationContext is not inside the context provider PaginationProvider',
    );
  }
  return context;
}

export { PaginationProvider, usePaginationContext };
