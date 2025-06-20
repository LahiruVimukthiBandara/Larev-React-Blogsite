import { Button } from "@headlessui/react";
import { useForm, usePage } from "@inertiajs/react";
import React, { FormEventHandler } from "react";

interface CreateCommentProps {
    postId: number;
}

export default function Create({ postId }: CreateCommentProps) {
    const { auth } = usePage().props as {
        auth: { user: { id: number } | null };
    };

    // If user is not logged in
    if (!auth.user) {
        return (
            <div className="py-5 text-sm text-center text-red-600">
                You must be logged in to post a comment.
            </div>
        );
    }

    const { data, setData, post, processing, errors, reset } = useForm({
        user_id: auth.user.id,
        post_id: postId,
        comment: "",
    });

    console.log(data);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("comment"), {
            onFinish: () => reset("comment"),
        });
    };

    return (
        <div className="flex flex-col w-full gap-3 py-5">
            <form onSubmit={submit}>
                <textarea
                    className="w-full h-40 p-2 border border-gray-300 rounded-lg"
                    id="comment"
                    name="comment"
                    placeholder="Write your comment here..."
                    value={data.comment}
                    onChange={(e) => setData("comment", e.target.value)}
                    required
                ></textarea>

                {errors.comment && (
                    <p className="mt-1 text-sm text-red-600">
                        {errors.comment}
                    </p>
                )}

                <div className="mt-2 ml-auto">
                    <Button
                        type="submit"
                        disabled={processing}
                        className="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 disabled:opacity-50"
                    >
                        {processing ? "Posting..." : "Comment"}
                    </Button>
                </div>
            </form>
        </div>
    );
}
