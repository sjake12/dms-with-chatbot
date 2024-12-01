import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import RoleGate from "@/Pages/Auth/RoleGate.jsx";
import Chip from '@mui/material/Chip';

export default function AuthenticatedLayout({ header, children }) {
    const user = usePage().props.auth.user;
    const role = usePage().props.auth.role;
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return (
        <div className="min-h-screen bg-gray-100">
            <nav className="border-b border-gray-100 bg-white">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between">
                        <div className="flex">
                            <div className="flex shrink-0 items-center">
                                <Link href="/" >
                                    <img src="https://sksu.edu.ph/wp-content/uploads/2021/04/sksu1.png"
                                         alt="SKSU-logo"
                                         className="block h-9 w-auto"
                                    />
                                </Link >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('dashboard')}
                                    active={route().current('dashboard')}
                                >
                                    Dashboard
                                </NavLink>
                            </div>

                            {role === 'student' && (
                                <RoleGate role="student" >
                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('student.index', user.student_id)}
                                            active={route().current('student.index')}
                                        >
                                            My Profile
                                        </NavLink >
                                    </div >
                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('academic-record.index', user.student_id)}
                                            active={route().current('academic-record.index')}
                                        >
                                            My Grades
                                        </NavLink >
                                    </div >
                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('enrollments.show', user.student_id)}
                                            active={route().current('enrollments.show')}
                                        >
                                            My Subject Enrollments
                                        </NavLink >
                                    </div >
                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('subjects.index')}
                                            active={route().current('subjects.index')}
                                        >
                                            Subjects
                                        </NavLink >
                                    </div >
                                </RoleGate >
                            )}

                            {role === 'faculty' && (
                                <RoleGate role="faculty" >
                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('faculty.show', user.faculty_id)}
                                            active={route().current('faculty.show')}
                                        >
                                            My Profile
                                        </NavLink >
                                    </div >

                                    <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                        <NavLink
                                            href={route('faculty-subject.index', user.faculty_id)}
                                            active={route().current('faculty-subject.index')}
                                        >
                                            My Subject Advisories
                                        </NavLink >
                                    </div >
                                </RoleGate >
                            )}
                        </div >

                        <div className="hidden sm:ms-6 sm:flex sm:items-center" >
                            <Chip label={role} size="small" />
                            <div className="relative ms-3" >
                                <Dropdown >
                                    <Dropdown.Trigger >
                                        <span className="inline-flex rounded-md" >
                                            <button
                                                type="button"
                                                className="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {user.first_name} {user.last_name}

                                                <svg
                                                    className="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg >
                                            </button >
                                        </span >
                                    </Dropdown.Trigger >

                                    <Dropdown.Content >
                                        <Dropdown.Link
                                            href={route('profile.edit')}
                                        >
                                            Settings
                                        </Dropdown.Link >
                                        <Dropdown.Link
                                            href={route('logout')}
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </Dropdown.Link >
                                    </Dropdown.Content >
                                </Dropdown >
                            </div >
                        </div >

                        <div className="-me-2 flex items-center sm:hidden" >
                            <button
                                onClick={() =>
                                    setShowingNavigationDropdown(
                                        (previousState) => !previousState,
                                    )
                                }
                                className="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    className="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        className={
                                            !showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={
                                            showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    className={
                        (showingNavigationDropdown ? 'block' : 'hidden') +
                        ' sm:hidden'
                    }
                >
                    <div className="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            href={route('dashboard')}
                            active={route().current('dashboard')}
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    {role === 'student' && (
                        <RoleGate role="student" >
                            <div className="space-y-1 pb-3 pt-2" >
                                <ResponsiveNavLink
                                    href={route('student.index', user.student_id)}
                                    active={route().current('student.index')}
                                >
                                    My Profile
                                </ResponsiveNavLink >
                            </div >
                            <div className="space-y-1 pb-3 pt-2" >
                                <ResponsiveNavLink
                                    href={route('academic-record.index', user.student_id)}
                                    active={route().current('academic-record.index')}
                                >
                                    My Grades
                                </ResponsiveNavLink >
                            </div >
                            <div className="space-y-1 pb-3 pt-2" >
                                <ResponsiveNavLink
                                    href={route('enrollments.show', user.student_id)}
                                    active={route().current('enrollments.show')}
                                >
                                    My Subject Enrollments
                                </ResponsiveNavLink >
                            </div >
                            <div className="space-y-1 pb-3 pt-2" >
                                <ResponsiveNavLink
                                    href={route('subjects.index')}
                                    active={route().current('subjects.index')}
                                >
                                    Subjects
                                </ResponsiveNavLink >
                            </div >
                        </RoleGate >
                    )}
                    <div className="border-t border-gray-200 pb-1 pt-4">
                        <div className="px-4">
                            <div className="text-base font-medium text-gray-800">
                                {user.name}
                            </div>
                            <div className="text-sm font-medium text-gray-500">
                                {user.email}
                            </div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink href={route('profile.edit')}>
                                Settings
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                method="post"
                                href={route('logout')}
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            {header && (
                <header className="bg-white shadow">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            <main>{children}</main>
        </div>
    );
}
