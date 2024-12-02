import React from 'react';
import {
    Box,
    Card,
    CardContent,
    CardHeader,
    Grid,
    Typography,
    LinearProgress
} from '@mui/material';
import {
    Calculator as CalculateIcon,
    BookOpen as BookOpenIcon,
    GraduationCap as GraduationCapIcon
} from 'lucide-react';
import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import NavLink from "@/Components/NavLink.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

const StudentDashboard = () => {
    const { gwa, currentlyEnrolledSubjects, completedSubjects, totalProspectusSubjects} = usePage().props.studentData;
    const subjectProgressPercentage =
        (completedSubjects / totalProspectusSubjects) * 100;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Student Dashboard
                </h2 >
            }
        >
            <Head title="Student Dashboard" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <Box sx={{ flexGrow: 1, p: 3 }}>
                                <Grid container spacing={3}>
                                    {/* GWA Card */}
                                    <Grid item xs={12} md={4}>
                                        <Card>
                                            <CardHeader
                                                avatar={<CalculateIcon />}
                                                title={
                                                    <Typography variant="subtitle1" color="text.secondary">
                                                        General Weighted Average
                                                    </Typography>
                                                }
                                            />
                                            <CardContent>
                                                <Typography variant="h4" color="primary">
                                                    {gwa.toFixed(2)}
                                                </Typography>
                                            </CardContent>
                                        </Card>
                                    </Grid>

                                    {/* Currently Enrolled Subjects Card */}
                                    <Grid item xs={12} md={4}>
                                        <Card>
                                            <CardHeader
                                                avatar={<BookOpenIcon />}
                                                title={
                                                    <Typography variant="subtitle1" color="text.secondary">
                                                        Currently Enrolled
                                                    </Typography>
                                                }
                                            />
                                            <CardContent>
                                                <Typography variant="h4" color="primary">
                                                    {currentlyEnrolledSubjects}
                                                </Typography>
                                            </CardContent>
                                        </Card>
                                    </Grid>

                                    {/* Subject Completion Progress Card */}
                                    <Grid item xs={12} md={4}>
                                        <Card>
                                            <CardHeader
                                                avatar={<GraduationCapIcon />}
                                                title={
                                                    <Typography variant="subtitle1" color="text.secondary">
                                                        Subjects Completed
                                                    </Typography>
                                                }
                                            />
                                            <CardContent>
                                                <Typography variant="h4" color="primary" gutterBottom>
                                                    {completedSubjects} / {totalProspectusSubjects}
                                                </Typography>
                                                <LinearProgress
                                                    variant="determinate"
                                                    value={subjectProgressPercentage}
                                                />
                                            </CardContent>
                                        </Card>
                                    </Grid>
                                </Grid>
                            </Box>
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )};

export default StudentDashboard;
