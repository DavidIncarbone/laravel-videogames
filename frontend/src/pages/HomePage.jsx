import axios from "axios";
import { useState, useEffect } from "react";
import { useGlobalContext } from "../contexts/GlobalContext";
import { Link } from "react-router-dom";
import Loader from "../components/Loader";
import Carousel from "../components/Carousel";

export default function HomePage() {

    // Dichiarazione variabili

    const { homepageVideogames, fetchHomepageVideogames, fileUrl } = useGlobalContext();

    // Dichiarazione funzioni

    useEffect(() => { fetchHomepageVideogames() }, []);

    return (
        <section id="videogames" className="py-5">
            <div className="container">
                <h2 className="text-center mb-4">Nuove uscite</h2>
                    <Carousel data={homepageVideogames} fileUrl={fileUrl} />
            </div>
        </section>

    )
}