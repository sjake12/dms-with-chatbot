import { usePage } from "@inertiajs/react";

export default function PermissionGate({ children, permission }) {
    const user = usePage().props.auth;

    if (!user.permissions?.includes(permission)) {
        return null;
    }

    return children;
}
