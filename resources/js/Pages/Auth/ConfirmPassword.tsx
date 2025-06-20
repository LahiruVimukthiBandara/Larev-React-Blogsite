import InputError from "@/Components/Core/InputError";
import InputLabel from "@/Components/Core/InputLabel";
import PrimaryButton from "@/Components/Core/PrimaryButton";
import TextInput from "@/Components/Core/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import GuestLayout from "@/Layouts/GuestLayout";
import { Head, useForm } from "@inertiajs/react";
import { FormEventHandler } from "react";

export default function ConfirmPassword() {
    const { data, setData, post, processing, errors, reset } = useForm({
        password: "",
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("password.confirm"), {
            onFinish: () => reset("password"),
        });
    };

    return (
        <AuthenticatedLayout>
            <Head title="Confirm Password" />

            <div className="card w-[350px] bg-white shadow p-5 mx-auto my-16">
                <div className="card-content">
                    <div className="mb-4 text-sm text-gray-600">
                        This is a secure area of the application. Please confirm
                        your password before continuing.
                    </div>

                    <form onSubmit={submit}>
                        <div className="mt-4">
                            <InputLabel htmlFor="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                isFocused={true}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                            />

                            <InputError
                                message={errors.password}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4 flex items-center justify-end">
                            <PrimaryButton
                                className="ms-4"
                                disabled={processing}
                            >
                                Confirm
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
