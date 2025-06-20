import { Link } from "@inertiajs/react";
import React from "react";

export default function Hero() {
    return (
        <div className="bg-white">
            <div className="relative isolate px-6 lg:px-8">
                <div
                    className="absolute inset-x-0 -top-10 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-20"
                    aria-hidden="true"
                >
                    <div className="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75"></div>
                </div>
                <div className="mx-auto max-w-2xl py-32 sm:py-32 lg:py-20">
                    <div className="hidden sm:mb-8 sm:flex sm:justify-center">
                        <div className="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            Discover the latest stories on CityTimes.
                            <Link
                                href="#"
                                className="font-semibold text-indigo-600"
                            >
                                <span
                                    className="absolute inset-0"
                                    aria-hidden="true"
                                ></span>
                                Visit the Blog
                                <span aria-hidden="true">&rarr;</span>
                            </Link>
                        </div>
                    </div>
                    <div className="text-center">
                        <h1 className="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">
                            Welcome to CityTimes
                        </h1>
                        <p className="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                            Your daily dose of city buzz, breaking news, local
                            insights, and thoughtful stories. Stay informed and
                            inspired with CityTimes.
                        </p>
                        <div className="mt-10 flex items-center justify-center gap-x-3">
                            <Link
                                as="button"
                                href="#"
                                className="btn btn-primary"
                            >
                                Read Latest Posts
                            </Link>
                            <Link
                                as="button"
                                href="#"
                                className="btn hover:bg-primary hover:text-white"
                            >
                                About Us <span aria-hidden="true">→</span>
                            </Link>
                        </div>
                    </div>
                </div>
                <div
                    className="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true"
                >
                    <div className="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"></div>
                </div>
            </div>
        </div>
    );
}
