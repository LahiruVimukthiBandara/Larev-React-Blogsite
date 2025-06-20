import { Link, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Post from "../Components/App/Post";
import Hero from "@/Components/App/Hero";
import Pagination from "@/Components/Core/Pagination";
import Category from "../Components/App/Category";
import Featured from "../Components/App/Featured";

export default function Home() {
    const { categories, posts, featured } = usePage().props as any;

    return (
        <AuthenticatedLayout>
            <Hero />
            <div className="px-4 py-8 bg-white border-t border-b max-w-screen sm:px-6 lg:px-20">
                <div className="flex flex-col items-center justify-center w-full py-14">
                    <h1 className="text-3xl font-bold text-center ">
                        Read our latest posts
                    </h1>
                    <div className="w-24 h-1 mt-2 rounded-full bg-primary"></div>
                </div>

                <div className="grid grid-cols-12 gap-2">
                    {/* first col */}
                    <div className="col-span-8">
                        {posts &&
                            posts.data.map((post: any) => (
                                <Post key={post.id} post={post} />
                            ))}
                        <div className="flex justify-center w-full">
                            <Pagination
                                links={posts.links}
                                currentPage={posts.current_page}
                                lastPage={posts.last_page}
                            />
                        </div>
                    </div>

                    {/* second col */}
                    <div className="col-span-4 px-4">
                        <div className="p-2 shadow-lg card">
                            <div className="flex flex-col gap-5 card-content">
                                <h1 className="text-2xl font-bold capitalize">
                                    about us
                                </h1>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit... Lorem ipsum dolor sit
                                    amet consectetur adipisicing elit... Lorem
                                    ipsum dolor sit amet consectetur adipisicing
                                    elit... Lorem ipsum dolor sit amet
                                    consectetur adipisicing elit... Lorem ipsum
                                    dolor sit amet consectetur adipisicing
                                    elit...
                                </p>
                                <Link
                                    as="button"
                                    href="#"
                                    className="py-2 text-white capitalize bg-primary rounded-xl"
                                >
                                    read more..
                                </Link>
                            </div>
                        </div>

                        {/* categories */}
                        <div className="p-2 mt-4 shadow-lg card">
                            <div className="flex flex-col gap-3 card-content">
                                <h1 className="capitalize">
                                    <ul>
                                        {categories &&
                                            categories.map((category: any) => (
                                                <Category
                                                    key={category.id}
                                                    category={category}
                                                />
                                            ))}
                                    </ul>
                                </h1>
                            </div>
                        </div>

                        {/* featured posts */}
                        <div className="p-2 mt-4 shadow-lg card">
                            <div className="flex flex-col gap-3 card-content">
                                <h1 className="text-2xl font-bold capitalize">
                                    featured posts
                                </h1>
                                {featured &&
                                    featured.map((featured: any) => (
                                        <Featured
                                            key={featured.id}
                                            featured={featured}
                                        />
                                    ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
