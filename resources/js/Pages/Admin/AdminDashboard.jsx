import React from 'react';
import {
    Box,
    Card,
    CardContent,
    Grid,
    Typography,
    TableContainer,
    Table,
    TableHead,
    TableBody,
    TableRow,
    TableCell,
    Paper
} from '@mui/material';
import { Users, UserCheck, Book, XCircle, CheckCircle } from 'lucide-react';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head } from "@inertiajs/react";

const Dashboard = ({
                       totalStudents,
                       enrolledStudents,
                       studentsPerProgram,
                       facultyLoads,
                       studentsPerProgramYear
                   }) => {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Admin Dashboard
                </h2 >
            }
        >
            <Head title="Admin Dashboard" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <Box sx={{
                                flexGrow: 1,
                                p: 3
                            }} >
                                {/* Summary Cards */}
                                <Grid container spacing={3} sx={{
                                    mb: 3,
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    height: '100%'
                                }} >
                                    <Grid item xs={12} sm={6} md={6} lg={3} >
                                        <Card sx={{ height: '100%' }} >
                                            <CardContent sx={{
                                                display: 'flex',
                                                alignItems: 'center',
                                                justifyContent: 'space-between',
                                                height: '100%'
                                            }} >
                                                <Box >
                                                    <Typography variant="h6" >Total Students</Typography >
                                                    <Typography variant="h4" >{totalStudents}</Typography >
                                                </Box >
                                                <Users size={48} />
                                            </CardContent >
                                        </Card >
                                    </Grid >

                                    <Grid item xs={12} sm={6} md={6} lg={3} >
                                        <Card sx={{ height: '100%' }} >
                                            <CardContent sx={{
                                                display: 'flex',
                                                alignItems: 'center',
                                                justifyContent: 'space-between',
                                                height: '100%'
                                            }} >
                                                <Box >
                                                    <Typography variant="h6" >Enrolled Students</Typography >
                                                    <Typography variant="h4" >{enrolledStudents}</Typography >
                                                </Box >
                                                <UserCheck size={48} />
                                            </CardContent >
                                        </Card >
                                    </Grid >
                                </Grid >

                                {/* Students per Program and Faculty Load */}
                                <Grid container spacing={3} sx={{ mb: 3 }} >
                                    <Grid item xs={12} md={6} >
                                        <Card sx={{ height: '100%' }} >
                                            <CardContent sx={{
                                                height: '100%',
                                                display: 'flex',
                                                flexDirection: 'column'
                                            }} >
                                                <Typography variant="h6" sx={{ mb: 2 }} >Students per
                                                    Program</Typography >
                                                <TableContainer component={Paper} sx={{ flexGrow: 1 }} >
                                                    <Table >
                                                        <TableHead >
                                                            <TableRow >
                                                                <TableCell >Program</TableCell >
                                                                <TableCell align="right" >Number of
                                                                    Students</TableCell >
                                                            </TableRow >
                                                        </TableHead >
                                                        <TableBody >
                                                            {studentsPerProgram.map((program) => (
                                                                <TableRow key={program.program_id} >
                                                                    <TableCell >{program.program_description}</TableCell >
                                                                    <TableCell
                                                                        align="right" >{program.students_count}</TableCell >
                                                                </TableRow >
                                                            ))}
                                                        </TableBody >
                                                    </Table >
                                                </TableContainer >
                                            </CardContent >
                                        </Card >
                                    </Grid >

                                    <Grid item xs={12} md={6} >
                                        <Card sx={{ height: '100%' }} >
                                            <CardContent sx={{
                                                height: '100%',
                                                display: 'flex',
                                                flexDirection: 'column'
                                            }} >
                                                <Typography variant="h6" sx={{ mb: 2 }} >Faculty Load</Typography >
                                                <TableContainer component={Paper} sx={{ flexGrow: 1 }} >
                                                    <Table >
                                                        <TableHead >
                                                            <TableRow >
                                                                <TableCell >Faculty Name</TableCell >
                                                                <TableCell align="right" >Total Units</TableCell >
                                                                <TableCell align="right" >Average Load</TableCell >
                                                            </TableRow >
                                                        </TableHead >
                                                        <TableBody >
                                                            {facultyLoads.map((faculty) => (
                                                                <TableRow key={faculty.faculty_id} >
                                                                    <TableCell >{`${faculty.first_name} ${faculty.last_name}`}</TableCell >
                                                                    <TableCell
                                                                        align="right" >{faculty.total_units}</TableCell >
                                                                    <TableCell
                                                                        align="right" >{faculty.average_load.toFixed(2)}</TableCell >
                                                                </TableRow >
                                                            ))}
                                                        </TableBody >
                                                    </Table >
                                                </TableContainer >
                                            </CardContent >
                                        </Card >
                                    </Grid >
                                </Grid >

                                {/* Students per Program and Year */}
                                <Grid container spacing={3} >
                                    <Grid item xs={12} >
                                        <Card >
                                            <CardContent >
                                                <Typography variant="h6" sx={{ mb: 2 }} >Students per Program and
                                                    Year</Typography >
                                                <TableContainer component={Paper} >
                                                    <Table >
                                                        <TableHead >
                                                            <TableRow >
                                                                <TableCell >Program</TableCell >
                                                                <TableCell align="right" >Year Levels</TableCell >
                                                            </TableRow >
                                                        </TableHead >
                                                        <TableBody >
                                                            {studentsPerProgramYear.map((program) => (
                                                                <TableRow key={program.program_id} >
                                                                    <TableCell >{program.program_description}</TableCell >
                                                                    <TableCell align="right" >
                                                                        {program.students.map((yearData) => (
                                                                            <Typography key={yearData.year_level} >
                                                                                Year {yearData.year_level}: {yearData.count}
                                                                            </Typography >
                                                                        ))}
                                                                    </TableCell >
                                                                </TableRow >
                                                            ))}
                                                        </TableBody >
                                                    </Table >
                                                </TableContainer >
                                            </CardContent >
                                        </Card >
                                    </Grid >
                                </Grid >
                            </Box >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
};

export default Dashboard;
