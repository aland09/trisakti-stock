<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables; 
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create($request->validated());

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $user) 
    // {
    //     $user->delete();

    //     return redirect()->route('users.index')
    //         ->withSuccess(__('User deleted successfully.'));
    // }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return redirect()->route('transactions.index')->with('error', 'Well done! Transaction deletion process has been completed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
    }

    public function datatables()
    {
        $users = User::latest()->get();
        return DataTables::of($users)
            ->addColumn('Aksi', function ($row) {
                $btn_view = view('layouts.partials.button-view', ['data' => $row->id, 'route' => 'users.show'])->render();
                $btn_edit = view('layouts.partials.button-edit', ['data' => $row->id, 'route' => 'users.edit'])->render();
                $btn_delete = view('layouts.partials.button-delete', ['data' => $row->id, 'route' => 'users.destroy','name' => $row->name])->render();
                return '<div class="d-flex">' . $btn_view . $btn_edit . $btn_delete . '</div>';
            })
            ->rawColumns(['Aksi'])
            ->make(true);
    }

}