import axios from "axios";
import { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import styles from '../style/videogameDetails.module.css';
import { useGlobalContext } from "../contexts/GlobalContext";
import Loader from "../components/Loader";

export default function VideogamePage() {

    // Dichiaro le variabili

    const { videogame, fetchVideogame, isLoading, fileUrl } = useGlobalContext();
    const { slug } = useParams();
    console.log(slug);

    // Dichiaro le funzioni

    useEffect(() => { fetchVideogame(slug) }, [slug]);


    return (
        <section className={`py-5 ${styles.videogameSection}`}>
            {isLoading ? <Loader /> :
                <div className="container">
                    <div className="row">
                        <div className="col-md-8">
                            <h1 className={styles.videogameTitle}>{videogame.name}</h1>
                            <div id="videogameImages" className={`carousel slide ${styles.carousel}`} data-bs-ride="carousel">
                                <div className="carousel-inner">
                                    <div className="carousel-item active">
                                        <img src={`${fileUrl}${videogame.cover}`} className="d-block w-100" alt={videogame.name} />
                                    </div>
                                </div>
                                <button className="carousel-control-prev" console="button" data-bs-target="#videogameImages" data-bs-slide="prev">
                                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">Previous</span>
                                </button>
                                <button className="carousel-control-next" type="button" data-bs-target="#videogameImages" data-bs-slide="next">
                                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span className="visually-hidden">Next</span>
                                </button>
                            </div>
                            <h3 className="mt-4">Descrizione</h3>
                            <p>{videogame.description}</p>

                            <h4 className="mt-4">Console</h4>
                            <ul className="d-flex gap-3">
                                {videogame.consoles?.map((console) => {
                                    return (<li className="m-1"
                                        key={console.id}>
                                        <div style={{ width: '50px' }}>
                                            <img src={`${fileUrl}${console.logo}`} alt="" />
                                        </div>
                                    </li>
                                    )
                                })}
                            </ul>
                        </div>


                    </div>
                </div>
            }
        </section >
    )
}