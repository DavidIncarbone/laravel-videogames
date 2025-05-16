import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { useGlobalContext } from './contexts/GlobalContext';
import DefaultLayout from './layouts/DefaultLayout';
import HomePage from './pages/HomePage';
import VideogamePage from './pages/VideogamePage';
import Videogames from './pages/Videogames';
import Loader from './components/Loader';
import NotFound from './pages/NotFound';
import { GlobalProvider } from './contexts/GlobalContext';

function App() {
  return (
    <BrowserRouter>
      <GlobalProvider>
        <Routes>
          <Route element={<DefaultLayout />}>
            <Route index element={<HomePage />} />
            <Route path="/videogame/:slug" element={<VideogamePage />} />
            <Route path="/videogames" element={<Videogames />} />
          </Route>
          <Route path="*" element={<NotFound />} />
        </Routes>
      </GlobalProvider>
    </BrowserRouter>
  );
}

export default App;
