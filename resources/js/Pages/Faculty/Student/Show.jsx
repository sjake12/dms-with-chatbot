import { Head, useForm, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";

export default function Show(){
    const { subject, student, faculty } = usePage().props;
    const grades = [
        '1.0', '1.25', '1.5', '1.75', '2.0', '2.25', '2.5', '2.75', '3.0', 'inc', 'drop'
    ];

    const { data, setData, patch, errors , processing} = useForm({
        grade: '',
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route('faculty-subject.student.update', { faculty, subject: subject.subject_id, student: student.student_id }), {
            onFinish : () => route('faculty-subject.show', { faculty, subject: subject.subject_id }),
        })
    }
    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        {subject.subject_code} - {subject.subject_description}
                    </h2 >

                    <NavLink href={route('faculty-subject.show', { faculty, subject: subject.subject_id })}>
                        <PrimaryButton>
                            Back
                        </PrimaryButton>
                    </NavLink>
                </div >
            }
        >
            <Head title="Assign Grade" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="text-2xl font-bold mb-6" >
                                {student.first_name} {student.last_name} - {student.program}, {student.year_level}
                            </h2 >

                            <form onSubmit={submit}>
                                <div >
                                    <InputLabel
                                        htmlFor="grade"
                                        value="Grade"
                                        className="text-xl mb-4"
                                    />

                                    <select
                                        id="grade"
                                        name="grade"
                                        value={data.grade}
                                        className="mt-1 block w-[25%]"
                                        onChange={(e) => setData('grade', parseFloat(e.target.value))}
                                    >
                                        <option value="" >Select a grade</option >
                                        {grades.map((grade, index) => (
                                            <option key={index} value={grade} >
                                                {grade}
                                            </option >
                                        ))}
                                    </select >

                                    <InputError message={errors.grade} className="mt-2" />
                                </div >
                                <PrimaryButton className="mt-4" disabled={processing} >
                                    Submit
                                </PrimaryButton >
                            </form >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
