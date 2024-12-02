import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import { useState } from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Index(){
    const faculties = usePage().props.faculties;
    const [searchQuery, setSearchQuery] = useState('');


    const filteredFaculties = faculties.filter(faculty =>
        (searchQuery === '' ||
            String(faculty.faculty_id).toLowerCase().includes(searchQuery.toLowerCase()) ||
            faculty.first_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            faculty.last_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            (faculty.middle_name && faculty.middle_name.toLowerCase().includes(searchQuery.toLowerCase())))
    );

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Faculties
                </h2 >
            }
        >
            <Head title="Faculties" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <NavLink href={route('admin-faculty-create')}>
                                <PrimaryButton>
                                    Add Faculty
                                </PrimaryButton>
                            </NavLink>
                            <input
                                type="text"
                                placeholder="Search students by ID, name..."
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 my-6"
                            />
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            ID
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Last Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            First Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Middle Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Email
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Actions
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {filteredFaculties
                                        .sort((a, b) => a.last_name.localeCompare(b.last_name))
                                        .map((faculty, index) => (
                                            <tr key={index} >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {faculty.faculty_id}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {faculty.last_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {faculty.first_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {faculty.middle_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {faculty.email}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    <NavLink
                                                        href={route('admin-faculty-show', { faculty: faculty.faculty_id })}
                                                    >
                                                    <span
                                                        className="bg-blue-500 text-white font-bold text-md py-2 px-3 rounded hover:bg-blue-400" >
                                                        View
                                                    </span >
                                                    </NavLink >
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
    );
}
