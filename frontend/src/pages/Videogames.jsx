import axios from 'axios';
import { useEffect } from 'react';
import { useGlobalContext } from "../contexts/GlobalContext";
import Loader from "../components/Loader";
import Card from "../components/Card";

export default function Videogames() {

    // Dichiarazione variabili

    const { videogames, fetchVideogames, consoles, fetchConsoles, genres, fetchGenres, pegis, fetchPegis, isLoading, fileUrl } = useGlobalContext();

    // Dichiarazione funzioni

    useEffect(() => { fetchVideogames(), fetchConsoles(), fetchGenres(), fetchPegis() }, []);


    return (

        <section id="videogames" className="py-5 bg-light">
            <div className="container">
                <h2 className="text-center mb-4">Lista videogiochi</h2>
                {isLoading ? <Loader /> :
                    <div className="row">
                        {videogames?.map((videogame) => {
                            return (
                                <Card data={videogame} fileUrl={fileUrl} key={videogame.id} />
                            )
                        })}
                    </div>
                }
            </div>
        </section>



    );
}