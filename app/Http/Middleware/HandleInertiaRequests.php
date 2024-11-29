<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $id = $request->user()->username ?? null;
        $user = Student::find($id) ?? Faculty::find($id) ?? Admin::find($id);
        $permissions = $request->user() ? $request->user()->getAllPermissions() : null;

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'permissions' => $permissions->map(function ($permission) {
                    return $permission->name;
                })
            ],
        ];
    }
}
