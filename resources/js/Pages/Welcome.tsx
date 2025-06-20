import Hero from "@/Components/App/Hero";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PageProps } from "@/types";
import { Head, Link } from "@inertiajs/react";
import Post from "@/Components/App/Post";

export default function Welcome({
    auth,
    laravelVersion,
    phpVersion,
}: PageProps<{
    laravelVersion: string;
    phpVersion: string;
}>) {
    const handleImageError = () => {
        document
            .getElementById("screenshot-container")
            ?.classList.add("!hidden");
        document.getElementById("docs-card")?.classList.add("!row-span-1");
        document
            .getElementById("docs-card-content")
            ?.classList.add("!flex-row");
        document.getElementById("background")?.classList.add("!hidden");
    };

    return (
        <AuthenticatedLayout>
            <Head title="Welcome" />
            <div>
                <Hero />
                <div className="px-4 py-8 bg-white border-t border-b max-w-screen sm:px-6 lg:px-20">
                    <div className="grid grid-cols-12 gap-2">
                        <div className="col-span-8"></div>
                        <div className="col-span-4 bg-red-200"></div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
