<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserManagementController extends Controller
{

    public function index(Request $request): View
    {
        $this->authorize('viewAny', User::class);

        $search = $request->get('search');
        
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        return view('user-management.index', compact('users', 'search'));
    }

    public function editRole(User $user): View
    {
        $this->authorize('update', $user);

        $availableRoles = ['admin', 'kepala_desa'];

        return view('user-management.edit-role', compact('user', 'availableRoles'));
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return Redirect::route('users.index')
                       ->with('status', 'Peran pengguna berhasil diperbarui');
    }

    public function show(User $user): View
    {
        $this->authorize('view', $user);

        return view('user-management.show', compact('user'));
    }
}
