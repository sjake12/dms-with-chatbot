import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";

export default function Index(){
    const subjects = usePage().props.subjects;
    const faculty = usePage().props.auth.user;

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Your Subject Advisories
                </h2 >
            }
        >
            <Head title="Subject Advisories" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Code
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Descriptive Title
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Units
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Actions
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {subjects.map((subject, index) => (
                                        <tr key={index} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {subject.subject_code}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {subject.subject_description}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {subject.units}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                <NavLink
                                                    href={route('faculty-subject.show', { subject: subject.subject_id, faculty: faculty.faculty_id })}
                                                >
                                                    <span className="bg-blue-500 text-white rounded-md py-2 px-3">
                                                        View Class List
                                                    </span>
                                                </NavLink>
                                            </td >
                                        </tr >
                                    ))}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
