import { Link } from 'react-router-dom';
import styles from '../style/Card.module.css';

export default function Card({ data, fileUrl }) {
  return (
    <div className="col-12 col-lg-3 g-3">
      <div className={`mb-3 ${styles.card}`}>
        <Link to={`/videogame/${data.slug}`}>
          <img
            src={fileUrl + data.cover}
            alt={data.name}
            className="rounded shadow-sm current-cover"
            style={{ objectFit: 'contain', height: '50vh' }}
          />
        </Link>
      </div>
    </div>
  );
}
