import { BrowserRouter, Routes, Route } from 'react-router-dom';
import DefaultLayout from './layouts/DefaultLayout';
import HomePage from './pages/HomePage';
import VideogamePage from './pages/VideogamePage';
import Videogames from './pages/Videogames';
import NotFound from './pages/NotFound';

// PROVIDERS
import { GlobalProvider } from './contexts/GlobalContext';
import { FilterProvider } from './contexts/FilterContext';
import { PaginationProvider } from './contexts/PaginationContext';
import { ShowProvider } from './contexts/ShowContext';
import { AdvancedSearchLayout } from './layouts/AdvancedSearchLayout';

function App() {
  return (
    <BrowserRouter>
      <GlobalProvider>
        <FilterProvider>
          <PaginationProvider>
            <ShowProvider>
              <Routes>
                <Route element={<DefaultLayout />}>
                  <Route index element={<HomePage />} />
                  <Route path="/videogame/:slug" element={<VideogamePage />} />

                  <Route path="/videogames" element={<Videogames />} />
                </Route>
                <Route path="*" element={<NotFound />} />
              </Routes>
            </ShowProvider>
          </PaginationProvider>
        </FilterProvider>
      </GlobalProvider>
    </BrowserRouter>
  );
}

export default App;
