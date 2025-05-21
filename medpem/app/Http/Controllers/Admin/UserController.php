<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // For admin, display only regular users
        // For superadmin, display all users
        if (Auth::user()->role === 'admin') {
            $users = Users::where('role', 'user')->orderBy('name')->paginate(10);
        } else {
            $users = Users::orderBy('role')->orderBy('name')->paginate(10);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Define roles based on current user's role
        $roles = ['user'];
        if (Auth::user()->role === 'superadmin') {
            $roles[] = 'admin';
        }

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => [
                'required',
                Rule::in(Auth::user()->role === 'superadmin' ? ['user', 'admin'] : ['user']),
            ],
        ]);

        // Create new user
        Users::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'total_points' => 0,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dibuat!');
    }

    /**
     * Display the specified user.
     */
    public function show(Users $user)
    {
        // Check if admin is trying to view admin or superadmin user
        if (Auth::user()->role === 'admin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki akses untuk melihat pengguna tersebut.');
        }

        // Load relationships for detailed view
        $user->load('lessons', 'materi', 'achievements');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(Users $user)
    {
        // Check if admin is trying to edit admin or superadmin user
        if (Auth::user()->role === 'admin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit pengguna tersebut.');
        }

        // Define roles based on current user's role
        $roles = ['user'];
        if (Auth::user()->role === 'superadmin') {
            $roles[] = 'admin';
            // Only superadmin can edit superadmin users
            if (Auth::user()->id === $user->id) {
                $roles[] = 'superadmin';
            }
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, Users $user)
    {
        // Check if admin is trying to update admin or superadmin user
        if (Auth::user()->role === 'admin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah pengguna tersebut.');
        }

        // Validate request
        $rules = [
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => [
                'required',
                Rule::in(Auth::user()->role === 'superadmin'
                    ? (Auth::user()->id === $user->id ? ['user', 'admin', 'superadmin'] : ['user', 'admin'])
                    : ['user']),
            ],
        ];

        // If password is provided, validate it
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6|confirmed';
        }

        $request->validate($rules);

        // Update user
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Users $user)
    {
        // Check if admin is trying to delete admin or superadmin user
        if (Auth::user()->role === 'admin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus pengguna tersebut.');
        }

        // Prevent superadmin from deleting themselves
        if (Auth::user()->id === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Delete user
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }

    /**
     * Export users data as CSV file.
     */
    public function exportUsers()
    {
        // Check if current user is admin or superadmin
        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk mengekspor data pengguna.');
        }

        // Get users based on role
        if (Auth::user()->role === 'admin') {
            $users = Users::where('role', 'user')->get();
        } else {
            $users = Users::all();
        }

        // Create filename with timestamp
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';

        // Create CSV response
        $response = new StreamedResponse(function() use ($users) {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'ID',
                'Nama',
                'Username',
                'Peran',
                'Total Poin',
                'Materi Selesai',
                'Pelajaran Selesai',
                'Tanggal Dibuat'
            ]);

            // Add user data
            foreach ($users as $user) {
                // Count completed materi and lessons
                $completedMaterials = $user->materi()
                    ->wherePivot('completed', true)
                    ->count();

                $completedLessons = $user->lessons()
                    ->wherePivot('completed', true)
                    ->count();

                fputcsv($handle, [
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->role,
                    $user->total_points ?? 0,
                    $completedMaterials,
                    $completedLessons,
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($handle);
        });

        // Set response headers
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
