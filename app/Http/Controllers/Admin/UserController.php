<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index', [
            'users' => User::with('roles')
                ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->string('q').'%')->orWhere('email', 'like', '%'.$request->string('q').'%'))
                ->orderBy('name')
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:student,admin'],
        ]);

        if ($user->id === $request->user()->id && $validated['role'] !== 'admin') {
            return back()->withErrors('No puedes quitarte el rol de administrador a ti mismo.');
        }

        $user->syncRoles([$validated['role']]);

        return back()->with('status', 'Rol actualizado.');
    }
}
