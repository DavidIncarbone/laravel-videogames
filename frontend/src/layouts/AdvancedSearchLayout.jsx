import { Outlet } from 'react-router-dom';
import { FilterProvider } from '../contexts/FilterContext';
import { PaginationProvider } from '../contexts/PaginationContext';

export const AdvancedSearchLayout = () => {
  //   <FilterProvider>
  <PaginationProvider>
    <Outlet />
  </PaginationProvider>;
  //   </FilterProvider>;
};
