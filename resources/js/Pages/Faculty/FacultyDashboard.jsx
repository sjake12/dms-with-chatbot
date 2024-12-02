import React from 'react';
import { Box, Card, CardContent, CardHeader, Grid, LinearProgress, Paper, Typography } from '@mui/material';
import {
    Book,
    Users,
    CheckCircle,
    XCircle,
    Calculator as CalculateIcon,
    BookOpen as BookOpenIcon,
    GraduationCap as GraduationCapIcon
} from 'lucide-react';
import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

const StatCard = ({ title, value, icon: Icon }) => (
    <Paper className="p-6 flex items-center space-x-4">
        <div className="p-3 bg-blue-100 rounded-full">
            <Icon className="w-8 h-8 text-blue-600" />
        </div>
        <div>
            <Typography variant="h6" className="font-medium">
                {title}
            </Typography>
            <Typography variant="h4" className="font-bold">
                {value}
            </Typography>
        </div>
    </Paper>
);

const SubjectsTable = ({ subjects }) => (
    <Paper className="mt-6 p-6">
        <Typography variant="h6" className="mb-4">
            Subjects Overview
        </Typography>
        <div className="overflow-x-auto">
            <table className="min-w-full">
                <thead>
                    <tr className="bg-gray-100">
                        <th className="p-4 text-left">Subject Code</th>
                        <th className="p-4 text-left">Description</th>
                        <th className="p-4 text-right">Students Without Grades</th>
                        <th className="p-4 text-right">Students With Grades</th>
                    </tr>
                </thead>
                <tbody>
                    {subjects.map((subject) => (
                        <tr key={subject.id} className="border-t">
                            <td className="p-4">{subject.code}</td>
                            <td className="p-4">{subject.description}</td>
                            <td className="p-4 text-right text-red-600">
                                {subject.studentsWithoutGrades}
                            </td>
                            <td className="p-4 text-right text-green-600">
                                {subject.studentsWithGrades}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    </Paper>
);

const Dashboard = () => {
    const { stats, subjects } = usePage().props;

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
                            <Typography variant="h4" className="mb-6" >
                                Faculty Dashboard
                            </Typography >

                            <Grid container spacing={4} >
                                <Grid item xs={12} md={4} >
                                    <StatCard
                                        title="Total Subjects"
                                        value={stats.totalSubjects}
                                        icon={Book}
                                    />
                                </Grid >
                                <Grid item xs={12} md={4} >
                                    <StatCard
                                        title="Students Without Grades"
                                        value={stats.totalStudentsWithoutGrades}
                                        icon={XCircle}
                                    />
                                </Grid >
                                <Grid item xs={12} md={4} >
                                    <StatCard
                                        title="Students With Grades"
                                        value={stats.totalStudentsWithGrades}
                                        icon={CheckCircle}
                                    />
                                </Grid >
                            </Grid >

                            <SubjectsTable subjects={subjects} />
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
};

export default Dashboard;
