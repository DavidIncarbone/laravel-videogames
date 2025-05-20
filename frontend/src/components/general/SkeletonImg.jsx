// ImageWithSkeleton.js
import React, { useState } from 'react';
import Skeleton from 'react-loading-skeleton';
import 'react-loading-skeleton/dist/skeleton.css';

const SkeletonImg = ({
  src,
  alt,
  objectFit,
  border,
  cursor,
  className,
  onClick,
}) => {
  const [isImgLoading, setisImgLoading] = useState(true);

  return (
    <div style={{ width: '100%', height: '100%' }}>
      {isImgLoading && (
        <Skeleton
          width={'100%'}
          height={'100%'}
          baseColor="#cccccc"
          highlightColor="#f0f0f0"
        />
      )}
      <div className="h-100 d-flex align-items-center">
        <img
          src={src}
          alt={alt}
          style={{
            objectFit,
            border,
            cursor,
            display: isImgLoading ? 'none' : 'block',
          }}
          onLoad={() => setisImgLoading(false)}
          onClick={onClick}
          className={`${className}`}
        />
      </div>
    </div>
  );
};

export default SkeletonImg;
