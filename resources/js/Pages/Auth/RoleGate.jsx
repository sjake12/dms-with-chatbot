import { usePage } from "@inertiajs/react";

export default function RoleGate({ children, role }) {
    const user = usePage().props.auth;

    if (user.role !== role) {
        return null;
    }

    return children;
}
