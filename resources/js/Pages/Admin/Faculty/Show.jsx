import { Head, useForm, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import React, { useState } from "react";
import Modal from "@/Components/Modal.jsx";

export default function Show(){
    const { faculty, facultySubjects } = usePage().props;

    const [confirmingFacultyDeletion, setConfirmingFacultyDeletion] = useState(false);
    const { delete: destroy } = useForm();

    const confirmFacultyDeletion = () => {
        setConfirmingFacultyDeletion(true);
    };

    const deleteFaculty = () => {
        destroy(route('admin-faculty-destroy', faculty.faculty_id), {
            preserveScroll: true,
            onSuccess: () => setConfirmingFacultyDeletion(false),
            onError: () => setConfirmingFacultyDeletion(false),
        });
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center" >
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Faculty Profile
                    </h2 >

                    <NavLink
                        href={route('admin-faculties')}
                    >
                        <PrimaryButton >
                            Back
                        </PrimaryButton >
                    </NavLink >
                </div >
            }
        >
            <Head title="Faculty Profile" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="text-2xl font-bold mb-4" >Personal Information</h2 >

                            <div className="grid grid-cols-2 gap-4" >
                                {Object.entries(faculty).map(([key, value]) => (
                                    <div className="mb-4 break-words" key={key} >
                                        <label className="block text-lg font-medium text-neutral-400" >
                                            {key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}:
                                        </label >
                                        <p className="mt-1 text-xl text-gray-900" >{value}</p >
                                    </div >
                                ))}
                            </div >

                            <div className="mt-6" >
                                <NavLink
                                    href={route('admin-faculty-edit', faculty.faculty_id)}
                                >
                                    <span
                                        className="text-white bg-blue-500 text-md py-2 px-3 rounded-lg hover:bg-blue-400" >
                                        Edit Faculty
                                    </span >
                                </NavLink >

                                <button
                                    onClick={confirmFacultyDeletion}
                                    className="text-white bg-red-500 text-md py-2 px-3 rounded-lg hover:bg-red-400"
                                >
                                    Delete Faculty
                                </button >
                            </div >
                        </div >
                    </div >
                </div >
            </div >

            <div className="py-12 pt-0" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="text-2xl font-bold mb-4" >Subjects</h2 >

                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Subject Code
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Descriptive Title
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Units
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {facultySubjects
                                        .map((subject, index) => (
                                            <tr key={index} >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {subject.subject_code}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {subject.description}
                                                </td >
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {subject.units}
                                                </td >
                                            </tr >
                                        ))}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div >

            {/* Confirmation Modal for Faculty Deletion */}
            <Modal
                show={confirmingFacultyDeletion}
                onClose={() => setConfirmingFacultyDeletion(false)}
            >
                <div className="p-6">
                    <h2 className="text-lg font-semibold text-gray-900">
                        Are you sure you want to delete this student?
                    </h2>
                    <p className="mt-1 text-sm text-gray-600">
                        This action cannot be undone. All student data will be permanently removed.
                    </p>
                    <div className="mt-6 flex justify-end space-x-4">
                        <button
                            onClick={() => setConfirmingFacultyDeletion(false)}
                            className="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        >
                            Cancel
                        </button>
                        <button
                            onClick={deleteFaculty}
                            className="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500"
                        >
                            Delete Faculty
                        </button>
                    </div>
                </div>
            </Modal>
        </AuthenticatedLayout >
    );
}
