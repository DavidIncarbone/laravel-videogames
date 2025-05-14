import { Link } from 'react-router-dom';
import styles from '../style/Card.module.css';

export default function Card({ data, fileUrl }) {
  return (
    <div className={`mb-3 position-relative ${styles.card}`}>
      <Link to={`/videogame/${data.slug}`}>
        <img
          src={fileUrl + data.cover}
          alt={data.name}
          className="rounded current-cover card-img-top "
          style={{
            objectFit: 'contain',
            height: '30vh',
            border: '3px,solid,white',
          }}
          loading="lazy"
        />

        {/* OVERLAY
        <div id={styles.cardOverlay}>
          <ul className="text-white">
            <li>{data.name}</li>
            <li>{data.pegi.age}</li>
            <li>
              <ul>
                {data.consoles.map((console) => (
                  <li>{console.name}</li>
                ))}
              </ul>
            </li>
            <li>
              <ul>
                {data.genres.map((genre) => (
                  <li>{genre.name}</li>
                ))}
              </ul>
            </li>
          </ul>
        </div> */}
      </Link>
    </div>
  );
}
