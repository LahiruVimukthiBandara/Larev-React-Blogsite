import { Link, usePage } from "@inertiajs/react";
import React from "react";

export default function Navbar() {
    const { auth } = usePage().props;
    const { user } = auth;

    return (
        <div className="navbar bg-base-100 shadow-sm">
            <div className="flex-1">
                <Link href="/" className="btn btn-ghost text-xl">
                    CityTimes
                </Link>
            </div>
            {user && (
                <div className="flex gap-2">
                    <input
                        type="text"
                        placeholder="Search"
                        className="input input-bordered w-24 md:w-auto"
                    />
                    <div className="dropdown dropdown-end">
                        <div
                            tabIndex={0}
                            role="button"
                            className="btn btn-ghost btn-circle avatar"
                        >
                            <div className="w-10 rounded-full">
                                <img
                                    alt="Tailwind CSS Navbar component"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                                />
                            </div>
                        </div>
                        <ul
                            tabIndex={0}
                            className="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow"
                        >
                            <li>
                                <Link
                                    href={route("dashboard")}
                                    className="justify-between"
                                >
                                    Dashboard
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href={route("profile.edit")}
                                    className="justify-between"
                                >
                                    Profile
                                </Link>
                            </li>
                            <li>
                                <Link href={route("logout")} method="post">
                                    Logout
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            )}

            {!user && (
                <div className="flex items-center gap-3">
                    <Link
                        href={route("login")}
                        as="button"
                        className="btn btn-primary"
                    >
                        Login
                    </Link>
                    <Link href={route("register")} as="button" className="btn">
                        register
                    </Link>
                </div>
            )}
        </div>
    );
}
