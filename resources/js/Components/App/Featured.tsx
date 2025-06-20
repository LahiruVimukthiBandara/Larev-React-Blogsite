import { Link } from "@inertiajs/react";
import React from "react";

interface featuredProps {
    featured: {
        id: number;
        thumbnail: string;
        title: string;
        body: string;
    };
}

export default function Featured({ featured }: featuredProps) {
    const imageUrl = "http://127.0.0.1:8000/storage/";

    console.log(featured);
    return (
        <div className="card bg-base-100 w-96 shadow-sm">
            <figure>
                <img
                    className="object-cover w-full h-40 rounded-lg"
                    src={imageUrl + featured.thumbnail}
                    alt={featured.title}
                />
            </figure>
            <div className="card-body">
                <h2 className="card-title">{featured.title}</h2>
                <p
                    className="text-sm font-light text-justify"
                    dangerouslySetInnerHTML={{
                        __html: featured.body?.substring(0, 200) + "...",
                    }}
                />
                <div className="card-actions justify-end">
                    <Link
                        href={`/posts/${featured.id}`}
                        className="text-sm link"
                    >
                        Continue reading &rarr;
                    </Link>
                </div>
            </div>
        </div>
    );
}
