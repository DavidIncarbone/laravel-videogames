import axios from "axios";
import { useState, useEffect } from "react";
import { useGlobalContext } from "../contexts/GlobalContext";
import { Link } from "react-router-dom";
import Loader from "../components/Loader";
import Card from "../components/Card";

export default function HomePage() {

    // Dichiarazione variabili

    const { homepageVideogames, fetchHomepageVideogames, isLoading, fileUrl } = useGlobalContext();

    // Dichiarazione funzioni

    useEffect(() => { fetchHomepageVideogames() }, []);

    return (
        <section id="videogames" className="py-5 bg-light">
            <div className="container">
                <h2 className="text-center mb-4">Nuove uscite</h2>
                {isLoading ? <Loader /> :
                    <div className="row">
                        {homepageVideogames?.map((videogame) => {
                            return (
                                <Card data={videogame} fileUrl={fileUrl} key={videogame.id} />
                            )
                        })}
                    </div>
                }
            </div>
        </section>

    )
}