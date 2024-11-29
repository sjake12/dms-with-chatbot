import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

export default function Show(){
   const student = usePage().props.student;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    My Profile
                </h2 >
            }
        >
            <Head title="My Profile" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="text-2xl font-bold mb-4" >Personal Information</h2 >

                            <div className="grid grid-cols-2 gap-4">
                                {Object.entries(student).map(([key, value]) => (
                                    <div className="mb-4 break-words" key={key}>
                                        <label className="block text-lg font-medium text-neutral-400">
                                            {key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}:
                                        </label>
                                        <p className="mt-1 text-xl text-gray-900">{value}</p>
                                    </div>
                                ))}
                            </div>
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
