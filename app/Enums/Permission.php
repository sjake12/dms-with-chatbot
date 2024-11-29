<?php

namespace App\Enums;

enum Permission: string
{
    case VIEW_STUDENT = 'view student';
    case VIEW_ALL_STUDENTS = 'view all students';
    case CREATE_STUDENT = 'create student';
    case UPDATE_STUDENT = 'update student';
    case DELETE_STUDENT = 'delete student';

    case VIEW_FACULTY = 'view faculty';
    case VIEW_ALL_FACULTIES = 'view all faculties';
    case CREATE_FACULTY = 'create faculty';
    case UPDATE_FACULTY = 'update faculty';
    case DELETE_FACULTY = 'delete faculty';

    case VIEW_ACADEMIC_RECORD = 'view academic record';
    case VIEW_ALL_ACADEMIC_RECORDS = 'view all academic records';
    case CREATE_ACADEMIC_RECORD = 'create academic record';
    case UPDATE_ACADEMIC_RECORD = 'update academic record';
    case DELETE_ACADEMIC_RECORD = 'delete academic record';

    case VIEW_ENROLLMENT = 'view enrollment';
    case VIEW_ALL_ENROLLMENTS = 'view all enrollments';
    case CREATE_ENROLLMENT = 'create enrollment';
    case UPDATE_ENROLLMENT = 'update enrollment';
    case DELETE_ENROLLMENT = 'delete enrollment';
}
