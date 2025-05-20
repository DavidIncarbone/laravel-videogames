import { createContext, useContext, useState, useRef } from 'react';
import axios from 'axios';
import { useSearchParams } from 'react-router-dom';

const FilterContext = createContext();

const FilterProvider = ({ children }) => {
  // GLOBAL SEARCH

  const [search, setSearch] = useState('');
};
