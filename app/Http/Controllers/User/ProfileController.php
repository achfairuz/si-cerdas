<?php

namespace App\Http\Controllers\User;

use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.admin.profile', compact('user'));
    }
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.form.form-profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {

            // 🔥 Hapus foto lama di Cloudinary
            if ($user->public_id) {
                CloudinaryHelper::delete($user->public_id);
            }

            $upload = CloudinaryHelper::upload(
                $request->file('photo'),
                'si-cerdas/users'
            );

            $user->photo = $upload['url'];
            $user->public_id = $upload['public_id'];
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        // Logout setelah update
        Auth::logout();

        return redirect()->route('login')
            ->with('success', 'Profile berhasil diperbarui. Silakan login kembali.');
    }

    public function changePasswordForm()
    {
        return view('pages.admin.form.form-change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Cek password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Password lama tidak sesuai.'
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Logout setelah berhasil
        Auth::logout();

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
