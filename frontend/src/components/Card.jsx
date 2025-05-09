import { Link } from "react-router-dom";

export default function Card({ data, fileUrl }) {
    return (
        <div className="col-md-4 mb-4">
            <div className="card shadow" style={{ height: "50vh" }} >
                <div className="h-50">
                    <img src={`${fileUrl}${data.cover}`} className="card-img-top overflow-y-hidden" alt={data.name} />
                </div>
                <div className="card-body mt-3">
                    <h5 className="card-title">{data.name}</h5>
                    <p className="card-text">{data.description.length <= 100 ? data.description : data.description.substring(0, 100) + "..."}</p>
                    <Link className="btn btn-dark mb-0" to={`/videogame/${data.slug}`}>Dettagli</Link>
                </div>
            </div>
        </div>
    )
}