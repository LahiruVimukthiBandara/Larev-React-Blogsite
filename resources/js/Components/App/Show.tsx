import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { format } from "date-fns";
import Comment from "../../Components/App/Comment";
import { usePage } from "@inertiajs/react";
import Create from "../../Components/App/Create";

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
    postId: number;
}

export default function Show({ post }: postProps) {
    const { comments } = usePage().props as any;
    const imageUrl = "http://127.0.0.1:8000/storage/";
    return (
        <AuthenticatedLayout>
            <div className="min-h-screen py-20 bg-white">
                <div className="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
                    {/* title */}
                    <div>
                        <h1 className="text-3xl font-bold ">{post.title}</h1>
                    </div>
                    {/* categories */}
                    <div className="flex gap-2 py-4">
                        {post.categories.map((cat) => (
                            <span
                                key={cat.id}
                                className="text-sm text-white badge badge-primary"
                            >
                                {cat.name}
                            </span>
                        ))}
                    </div>
                    {/* published date and time */}
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
                                    "MMMM do yyyy"
                                )}
                            </span>
                        </h1>
                    </div>
                    {/* image */}
                    <div className="w-full">
                        <div className="w-full h-auto">
                            <img
                                src={imageUrl + post.thumbnail}
                                alt={post.title}
                            />
                        </div>
                    </div>
                    {/* body */}
                    <div>
                        <div dangerouslySetInnerHTML={{ __html: post.body }} />
                    </div>

                    {/* comments */}

                    <Create postId={post.id} />

                    <div>
                        {comments &&
                            comments.data.map((comment: any) => (
                                <Comment key={comment.id} comment={comment} />
                            ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
