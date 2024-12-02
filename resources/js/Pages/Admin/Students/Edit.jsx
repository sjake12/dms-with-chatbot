import { Head, useForm, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import { ProgramSelector, YearLevelSelector } from "@/Components/ProgramYearSelector.jsx";
import { useEffect, useState } from "react";
import { Button } from "@mui/material";

export default function Show(){
    const { student, programs, yearLevels } = usePage().props;
    const [isChanged, setIsChanged] = useState(false);

    const { data, setData, patch, processing, errors } = useForm({
        'student_id': student.student_id,
        'first_name': student.first_name,
        'middle_name': student.middle_name || '',
        'last_name': student.last_name,
        'program_id': student.program_id,
        'year_level_id': student.year_level_id,
        'email': student.email,
        'phone_number': student.phone_number,
        'address': student.address,
    });

    console.log(errors);

    useEffect(() => {
        const isDataChanged = Object.keys(data).some(key => {
            // Special handling for phone number to match the input field name
            const originalValue = key === 'phone' ? student.phone_number :
                key === 'program_id' ? student.program_id :
                    key === 'year_level_id' ? student.year_level_id :
                        student[key];
            return data[key] !== originalValue;
        });
        setIsChanged(isDataChanged);
    }, [data, student]);

    const submit = (e) => {
        e.preventDefault();
        if (isChanged && !processing) {
            // Rename keys to match backend expectations
            const submitData = {
                ...data,
                program_id: data.program_id,
                year_level_id: data.year_level_id
            };

            // Remove the original keys that don't match backend
            delete submitData.program_id;
            delete submitData.year_level_id;

            patch(route('admin-student-update', { student: student.student_id }), submitData);
        }
    }

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        Student Profile
                    </h2>

                    <NavLink
                        href={route('admin-student-show', student.student_id)}
                    >
                        <PrimaryButton>
                            Back
                        </PrimaryButton>
                    </NavLink>
                </div>
            }
        >
            <Head title="My Profile" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="text-2xl font-bold mb-4">Personal Information</h2>

                            <form onSubmit={submit}>
                                <div className="grid grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel htmlFor="studentId" value="Student ID" />

                                        <TextInput
                                            id="studentId"
                                            type="text"
                                            name="student_id"
                                            value={data.student_id}
                                            className="mt-1 block w-full bg-neutral-200"
                                            autoComplete="username"
                                            disabled={true}
                                        />

                                        <InputError message={errors.student_id} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="firstName" value="First Name" />

                                        <TextInput
                                            id="firstName"
                                            type="text"
                                            name="first_name"
                                            value={data.first_name}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('first_name', e.target.value)}
                                            autoComplete="first_name"
                                        />

                                        <InputError message={errors.first_name} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="middleName" value="Middle Name" />

                                        <TextInput
                                            id="middleName"
                                            type="text"
                                            name="middle_name"
                                            value={data.middle_name}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('middle_name', e.target.value)}
                                            autoComplete="middle_name"
                                        />

                                        <InputError message={errors.middle_name} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="lastName" value="Last Name" />

                                        <TextInput
                                            id="lastName"
                                            type="text"
                                            name="last_name"
                                            value={data.last_name}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('last_name', e.target.value)}
                                            autoComplete="last_name"
                                        />

                                        <InputError message={errors.last_name} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="program" value="Program" />

                                        <ProgramSelector
                                            programs={programs}
                                            value={data.program_id}
                                            onChange={(value) => setData('program_id', value)}
                                            error={errors.program_id}
                                        />

                                        <InputError message={errors.program_id} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="year_level" value="Year Level" />

                                        <YearLevelSelector
                                            yearLevels={yearLevels}
                                            value={data.year_level_id}
                                            onChange={(value) => setData('year_level_id', value)}
                                            error={errors.year_level_id}
                                        />

                                        <InputError message={errors.year_level_id} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="email" value="Email" />

                                        <TextInput
                                            id="email"
                                            type="email"
                                            name="email"
                                            value={data.email}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('email', e.target.value)}
                                            autoComplete="email"
                                        />

                                        <InputError message={errors.email} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="phone" value="Phone Number" />

                                        <TextInput
                                            id="phone"
                                            type="text"
                                            name="phone_number"
                                            value={data.phone_number}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('phone_number', e.target.value)}
                                            autoComplete="phone_number"
                                        />

                                        <InputError message={errors.phone_number} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="address" value="Address" />

                                        <TextInput
                                            id="address"
                                            type="text"
                                            name="address"
                                            value={data.address}
                                            isFocused={true}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('address', e.target.value)}
                                            autoComplete="address"
                                        />

                                        <InputError message={errors.address} className="mt-2" />
                                    </div>
                                </div>

                                <div className="mt-6">
                                    <Button
                                        variant="contained"
                                        type="submit"
                                        disabled={!isChanged || processing}
                                    >
                                        Save
                                    </Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
