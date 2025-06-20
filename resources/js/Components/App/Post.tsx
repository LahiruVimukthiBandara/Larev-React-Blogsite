import { Link } from "@inertiajs/react";
import { format } from "date-fns";
import React from "react";

interface postProps {
    post: {
        id: number;
        title: string;
        slug: string;
        thumbnail: string;
        categories: { id: number; name: string }[];
        user: {
            name: string;
        };
        body: string;
        active: boolean;
        published_date: string;
        user_id: number;
    };
}

export default function Post({ post }: postProps) {
    const imageUrl = "http://127.0.0.1:8000/storage/";
    return (
        <div className="flex flex-col gap-2">
            <div className="p-5 shadow-md card">
                <div className="card-content">
                    {/* image */}
                    <div className="w-full">
                        <div className="relative w-full h-64">
                            <img
                                className="object-cover w-full h-full rounded-lg"
                                src={imageUrl + post.thumbnail}
                                alt={post.title}
                            />
                        </div>
                    </div>

                    {/* category */}
                    <div className="py-3">
                        <h1 className="flex gap-2 font-light capitalize">
                            {post.categories.map((cat) => (
                                <span
                                    key={cat.id}
                                    className="text-xs text-white badge badge-primary"
                                >
                                    {cat.name}
                                </span>
                            ))}
                        </h1>
                    </div>

                    {/* title */}
                    <div>
                        <h1 className="text-4xl font-bold text-black capitalize">
                            {post.title}
                        </h1>
                    </div>

                    {/* created at and created by */}
                    <div className="py-2 capitalize">
                        <h1 className="text-xs text-gray-500">
                            By{" "}
                            <span className="font-bold capitalize">
                                {post.user?.name}
                            </span>{" "}
                            . published on{" "}
                            <span className="font-bold capitalize text-primary">
                                {format(
                                    new Date(post.published_date),
                                    "d MMMM yyyy"
                                )}
                            </span>
                        </h1>
                    </div>

                    {/* body */}
                    <div>
                        <p
                            className="text-sm font-light text-justify"
                            dangerouslySetInnerHTML={{
                                __html: post.body?.substring(0, 200) + "...",
                            }}
                        />
                    </div>

                    {/* button */}
                    <div className="mt-3">
                        <Link
                            href={`/posts/${post.id}`}
                            className="text-sm link"
                        >
                            Continue reading &rarr;
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
