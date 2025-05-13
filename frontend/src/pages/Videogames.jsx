import { useEffect, useState } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import Card from '../components/Card';
import Paginator from '../components/Paginator';
import { useLocation, useNavigate } from 'react-router-dom';
export default function Videogames() {
  // VARIABLES

  const { fileUrl, fetchVideogames, videogames, pagination, totalVideogames } =
    useGlobalContext();

  const location = useLocation();
  const navigate = useNavigate();

  const queryParams = new URLSearchParams();

  const querySearch = new URLSearchParams(location.search);
  const search = querySearch.get('search') || '';
  const [page, setPage] = useState(+querySearch.get('page') || '');

  // FUNCTIONS

  const handlePageChange = (newPage) => {
    if (newPage >= 1 && newPage <= pagination.last_page) {
      setPage(newPage);
    }
  };

  useEffect(() => {
    if (page) {
      queryParams.set('page', page);
    }

    if (search) {
      queryParams.set('search', search);
    }

    navigate(`?${queryParams.toString()}`, { replace: true });
    fetchVideogames(search, page);
  }, [search, page]);

  return videogames.length > 0 ? (
    <section id="videogames">
      <div className="container">
        <h2 className="text-center mb-4">
          Lista videogiochi:
          <span className="fw-bold text-primary ms-2">{totalVideogames}</span>
        </h2>
        <div className="row">
          {videogames?.map((videogame) => (
            <Card data={videogame} fileUrl={fileUrl} key={videogame.id} />
          ))}
        </div>
      </div>
      {pagination.last_page > 1 && (
        <Paginator
          pageChange={handlePageChange}
          currentPage={page}
          pagination={pagination}
        />
      )}
    </section>
  ) : (
    <p className="fw-bold text-center">
      Nessun videogioco soddisfa i requisiti di ricerca
    </p>
  );
}
