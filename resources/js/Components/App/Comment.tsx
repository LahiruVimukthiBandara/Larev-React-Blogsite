import { format } from "date-fns";

interface commentProps {
    comment: {
        id: number;
        user: {
            id: number;
            name: string;
        };
        user_id: number;
        post_id: number;
        comment: string;
        created_at: string;
    };
}

export default function Comment({ comment }: commentProps) {
    return (
        <>
            {/* show comments */}
            <div className="mt-5 shadow card">
                <div className="flex flex-col gap-2 p-5 card-content">
                    <h1 className="text-lg font-bold capitalize">
                        {comment.user.name}
                    </h1>
                    <span className="text-xs text-primary">
                        {format(new Date(comment.created_at), "d MMMM yyyy")}
                    </span>
                    <p className="text-sm text-gray-600">{comment.comment}</p>
                </div>
            </div>
        </>
    );
}
