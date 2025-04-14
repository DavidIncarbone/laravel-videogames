import axios from "axios";
import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import styles from '../style/videogameDetails.module.css';
import { useGlobalContext } from "../contexts/GlobalContext";
import Loader from "../components/Loader";

export default function videogamePage() {

    // Dichiaro le variabili

    const { videogame, fetchvideogame, isLoading, fileUrl } = useGlobalContext();
    const { id } = useParams();
    type.log(id);

    // Dichiaro le funzioni

    useEffect(() => { fetchvideogame(id) }, [id]);


    return (
        <section className={`py-5 ${styles.videogamesection}`}>
            {isLoading ? <Loader /> :
                <div className="container">
                    <div className="row">
                        <div className="col-md-8">
                            <h1 className={styles.videogameTitle}>{videogame.name}</h1>
                            <div id="videogameImages" className={`carousel slide ${styles.carousel}`} data-bs-ride="carousel">
                                <div className="carousel-inner">
                                    <div className="carousel-item active">
                                        <img src={`${fileUrl}${videogame.image}`} className="d-block w-100" alt={videogame.name} />
                                    </div>
                                </div>
                                <button className="carousel-control-prev" type="button" data-bs-target="#videogameImages" data-bs-slide="prev">
                                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">Previous</span>
                                </button>
                                <button className="carousel-control-next" type="button" data-bs-target="#videogameImages" data-bs-slide="next">
                                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">Next</span>
                                </button>
                            </div>
                            <h3 className="mt-4">Descrizione del videogioco</h3>
                            <p>{videogame.summary}</p>

                            <h4 className="mt-4">generi Usate</h4>
                            <ul className={styles.techList}>
                                {videogame.genres?.map((genre) => {
                                    return (<li className="badge m-1"
                                        style={{ backgroundColor: `${genre.color}` }} key={genre.id}>
                                        {genre.name}</li>
                                    )
                                })}

                            </ul>

                            <a href={videogame.link} className={`btn btn-dark mt-4 ${styles.videogameButton}`}>Visita il videogioco</a>
                        </div>


                    </div>
                </div>
            }
        </section >
    )
}