import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import NavLink from "@/Components/NavLink.jsx";
import { useState } from "react";

export default function Show(){
    const students = usePage().props.students;
    const [selectedProgram, setSelectedProgram] = useState('All');
    const [searchQuery, setSearchQuery] = useState('');

    // Program full names mapping
    const programNames = {
        'BSCS': 'Bachelor of Science in Computer Science',
        'BSIT': 'Bachelor of Science in Information Technology',
        'BSIS': 'Bachelor of Science in Information Systems',
        'All': 'All Programs'
    };

    // Filter students based on selected program and search query
    const filteredStudents = students.filter(student =>
        (selectedProgram === 'All' || student.program === selectedProgram) &&
        (searchQuery === '' ||
            String(student.student_id).toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.first_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.last_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            (student.middle_name && student.middle_name.toLowerCase().includes(searchQuery.toLowerCase())))
    );

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Students
                </h2>
            }
        >
            <Head title="My Grades" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="flex flex-col space-y-4 mb-6">
                                <div className="flex justify-between items-center">
                                    <div className="space-x-2">
                                        {Object.keys(programNames).map(program => (
                                            <button
                                                key={program}
                                                onClick={() => setSelectedProgram(program)}
                                                className={`px-4 py-2 rounded ${
                                                    selectedProgram === program
                                                        ? 'bg-blue-500 text-white'
                                                        : 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                                                }`}
                                                title={programNames[program]}
                                            >
                                                {program}
                                            </button>
                                        ))}
                                    </div>
                                    <NavLink href={route('admin-student-create')}>
                                        <PrimaryButton>
                                            Add Student
                                        </PrimaryButton>
                                    </NavLink>
                                </div>
                                <input
                                    type="text"
                                    placeholder="Search students by ID, name..."
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>
                            <table className="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Last Name
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            First Name
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Middle Name
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Program
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Year Level
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white divide-y divide-gray-200">
                                    {filteredStudents
                                        .sort((a, b) => a.last_name.localeCompare(b.last_name))
                                        .map((student, index) => (
                                            <tr key={index}>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.student_id}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.last_name}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.first_name}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.middle_name}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.program}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {student.year_level}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <NavLink
                                                        href={route('admin-student-show', student.student_id)}
                                                    >
                                                    <span className="bg-blue-500 text-white font-bold text-md py-2 px-3 rounded hover:bg-blue-400">
                                                        View
                                                    </span>
                                                    </NavLink>
                                                </td>
                                            </tr>
                                        ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
