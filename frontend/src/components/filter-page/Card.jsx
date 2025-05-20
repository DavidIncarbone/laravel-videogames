import { Link } from 'react-router-dom';
import styles from '../../style/Card.module.css';
import SkeletonImg from '../general/SkeletonImg';

export default function Card({ data, fileUrl }) {
  return (
    <div
      className={`mb-3 position-relative ${styles.card}`}
      style={{ height: '30vh' }}
    >
      <Link to={`/videogame/${data.slug}`}>
        <SkeletonImg
          src={fileUrl + data.cover}
          alt={data.name}
          objectFit={'contain'}
          border={'3px,solid,white'}
          className={'rounded current-cover card-img-top'}
        />
      </Link>
    </div>
  );
}
