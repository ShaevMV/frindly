<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\FriendlyTicket;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private CreateNewUser $createNewUser;
    private UpdateUserProfileInformation $updateUserProfileInformation;
    private UpdateUserPassword $updateUserPassword;

    public function __construct(
        CreateNewUser $createNewUser,
        UpdateUserProfileInformation $updateUserProfileInformation,
        UpdateUserPassword $updateUserPassword
    )
    {
        $this->createNewUser = $createNewUser;
        $this->updateUserProfileInformation = $updateUserProfileInformation;
        $this->updateUserPassword = $updateUserPassword;
    }

    /**
     * @return Application|Factory|View
     */
    public function view()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users = User::where(['is_admin' => false])
            ->get();

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function editUser(int $id)
    {
        return view('auth.register', [
            'user' => User::find($id),
        ]);
    }

    public function createUser()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request): RedirectResponse
    {
        if ($id = $request->post('id', null)) {
            $user = User::find($id);
            $this->updateUserProfileInformation->update($user, $request->post());
            if (null !== $request->post('password', null)) {
                $this->updateUserPassword->update($user, $request->post());
            }
        } else {
            $this->createNewUser->create($request->post());
        }

        return redirect()->route('adminUser');
    }

    public function delUser(Request $request): RedirectResponse
    {
        $id = $request->post('id');

        User::destroy($id);

        return redirect()->route('adminUser');
    }

    public function tickets()
    {
        $tickets = FriendlyTicket::all();

        return view('admin.tickets', [
            'tickets' => $tickets,
        ]);
    }

    public function delTicket(Request $request): RedirectResponse
    {
        $id = $request->post('id');

        FriendlyTicket::destroy($id);

        return redirect()->route('adminTickets');
    }
}
