<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Support\ActivityLogger;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->with('role')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.form', [
            'user' => new User(['is_active' => true]),
            'roles' => Role::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateUser($request);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::query()->create($validated);
        ActivityLogger::log('user.created', 'User admin dibuat.', $user);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.form', [
            'user' => $user,
            'roles' => Role::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $this->validateUser($request, $user);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        ActivityLogger::log('user.updated', 'User admin diperbarui.', $user);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['general' => 'Anda tidak bisa menghapus akun yang sedang dipakai.']);
        }

        $user->delete();
        ActivityLogger::log('user.deleted', 'User admin dihapus.');

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    private function validateUser(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120', 'unique:users,email,'.($user?->id ?? 'NULL')],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'two_factor_enabled' => false,
        ];
    }
}

