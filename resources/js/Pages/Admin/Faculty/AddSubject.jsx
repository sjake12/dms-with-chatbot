import React from 'react';
import { Head, useForm } from '@inertiajs/react';
import {
    TextField,
    Autocomplete,
    Button,
    Grid,
    Paper,
    Typography
} from '@mui/material';
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import Modal from "@/Components/Modal.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

export default function AddSubject({ faculty, subjects }) {
    const { data, setData, post, reset, errors, processing } = useForm({
        subject_id: null,
        subject_code: '',
        description: '',
        units: '',
    });

    const handleSubjectSelect = (event, newValue) => {
        if (newValue) {
            setData({
                subject_id: newValue.subject_id,
                subject_code: newValue.subject_code,
                description: newValue.description,
                units: newValue.units.toString(),
            });
        } else {
            setData({
                subject_id: null,
                subject_code: '',
                description: '',
                units: '',
            });
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('admin-faculty-subject-store', { faculty: faculty.faculty_id }), {
            preserveScroll: true,
            onSuccess: () => {
                reset();
            },
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
                            <Paper elevation={3} sx={{ p: 3, maxWidth: 600, margin: 'auto' }}>
                                <Typography variant="h5" gutterBottom>
                                    Add Subject to {faculty.first_name} {faculty.last_name}
                                </Typography>
                                <form onSubmit={handleSubmit}>
                                    <Grid container spacing={3}>
                                        <Grid item xs={12}>
                                            <Autocomplete
                                                options={subjects}
                                                getOptionLabel={(option) => option.subject_code || ''}
                                                value={subjects.find(s => s.subject_id === data.subject_id) || null}
                                                onChange={(event, newValue) => handleSubjectSelect(event, newValue)}
                                                renderInput={(params) => (
                                                    <TextField
                                                        {...params}
                                                        label="Select Subject"
                                                        variant="outlined"
                                                        fullWidth
                                                        error={!!errors.subject_id}
                                                        helperText={errors.subject_id}
                                                    />
                                                )}
                                            />
                                        </Grid>
                                        <Grid item xs={12} md={6}>
                                            <TextField
                                                fullWidth
                                                label="Subject Code"
                                                variant="outlined"
                                                value={data.subject_code}
                                                onChange={(e) => setData('subject_code', e.target.value)}
                                                required
                                                error={!!errors.subject_code}
                                                helperText={errors.subject_code}
                                            />
                                        </Grid>
                                        <Grid item xs={12} md={6}>
                                            <TextField
                                                fullWidth
                                                label="Units"
                                                type="number"
                                                variant="outlined"
                                                value={data.units}
                                                onChange={(e) => setData('units', e.target.value)}
                                                required
                                                error={!!errors.units}
                                                helperText={errors.units}
                                            />
                                        </Grid>
                                        <Grid item xs={12}>
                                            <TextField
                                                fullWidth
                                                label="Description"
                                                variant="outlined"
                                                multiline
                                                rows={4}
                                                value={data.description}
                                                onChange={(e) => setData('description', e.target.value)}
                                                required
                                                error={!!errors.description}
                                                helperText={errors.description}
                                            />
                                        </Grid>
                                        <Grid item xs={12}>
                                            <Button
                                                type="submit"
                                                variant="contained"
                                                color="primary"
                                                fullWidth
                                                disabled={processing}
                                            >
                                                Add Subject
                                            </Button>
                                        </Grid>
                                    </Grid>
                                </form>
                            </Paper>
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
