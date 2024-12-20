import { usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import NavLink from "@/Components/NavLink.jsx";
import { useState } from "react";

export default function Show() {
    const classList = usePage().props.class_list;
    const subject = usePage().props.class;
    const faculty = usePage().props.auth.user;
    const [searchQuery, setSearchQuery] = useState('');

    // Filter students based on selected program and search query
    const filteredStudents = classList.filter(student =>
        (searchQuery === '' ||
            String(student.student_id).toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.first_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.last_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            (student.middle_name && student.middle_name.toLowerCase().includes(searchQuery.toLowerCase())))
    );

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        {subject.subject_code} - {subject.subject_description}
                    </h2 >

                    <NavLink
                        href={route('faculty-subject.index', faculty.faculty_id) }
                    >
                        <PrimaryButton>
                            Back
                        </PrimaryButton>
                    </NavLink>
                </div >
            }
        >
            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900" >
                            <input
                                type="text"
                                placeholder="Search students by ID, name..."
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6"
                            />
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Student ID
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
                                            Grade
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Actions
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {filteredStudents
                                        .sort((a, b) => a.last_name.localeCompare(b.last_name))
                                        .map((student, index) => (
                                            <tr key={index} >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {student.student_id}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {student.last_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {student.first_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {student.middle_name}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {student.grade}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    <NavLink
                                                        href={route('academic-record.show', {
                                                            student: student.student_id,
                                                            subject: subject.subject_id
                                                        })}
                                                    >
                                                    <span
                                                        className="bg-blue-500 text-white text-md font-bold py-2 px-3 rounded-lg hover:bg-blue-400" >
                                                        Assign Grade
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
    )
}
