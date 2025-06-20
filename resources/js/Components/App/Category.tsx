import React from "react";

interface categoriesProps {
    category: {
        id: number;
        name: string;
        slug: string;
    };
}

export default function Category({ category }: categoriesProps) {
    return (
        <div className="">
            <ul className="p-2 list-disc list-inside rounded-lg shadow-sm">
                <li className="text-sm text-gray-700 transition cursor-pointer hover:text-primary">
                    {category.name}
                </li>
            </ul>
        </div>
    );
}
