import { Head, useForm, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import { ProgramSelector, YearLevelSelector } from "@/Components/ProgramYearSelector.jsx";
import { Button } from "@mui/material";

export default function Create() {
    const { programs, yearLevels } = usePage().props;

    const { data, setData, post, processing, errors } = useForm({
        student_id: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        program_id: '',
        year_level_id: '',
        email: '',
        phone_number: '',
        address: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('admin-student-store'), {
            preserveScroll: true,
        });
    }

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        Create New Student
                    </h2>

                    <NavLink href={route('admin-student')}>
                        <PrimaryButton>
                            Back to Students
                        </PrimaryButton>
                    </NavLink>
                </div>
            }
        >
            <Head title="Create Student" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="text-2xl font-bold mb-4">Student Information</h2>

                            <form onSubmit={submit}>
                                <div className="grid grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel htmlFor="studentId" value="Student ID" />
                                        <TextInput
                                            id="studentId"
                                            type="text"
                                            name="student_id"
                                            value={data.student_id}
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('student_id', e.target.value)}
                                            autoComplete="off"
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
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('first_name', e.target.value)}
                                            autoComplete="given-name"
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
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('middle_name', e.target.value)}
                                            autoComplete="additional-name"
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
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('last_name', e.target.value)}
                                            autoComplete="family-name"
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
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('phone_number', e.target.value)}
                                            autoComplete="tel"
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
                                            className="mt-1 block w-full"
                                            onChange={(e) => setData('address', e.target.value)}
                                            autoComplete="street-address"
                                        />
                                        <InputError message={errors.address} className="mt-2" />
                                    </div>
                                </div>

                                <div className="mt-6">
                                    <Button
                                        variant="contained"
                                        type="submit"
                                        disabled={processing}
                                    >
                                        Create Student
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
