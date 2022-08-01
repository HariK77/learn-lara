<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // sleep(2);
        $page = $request->page ?? 0;
        $perPage = $request->per_page ?? 10;
        $offset = $page * $perPage;
        $search = $request->search;
        $orderBy = $request->order_by ?? 'id';

        $query = User::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
        $totalRecords = $query->count();

        $query->offset($offset)->limit($perPage);

        $query->orderBy($orderBy, 'ASC');
        $users = $query->get();
        return response()->json([
            'users' => $users,
            'total_records' => $totalRecords,
            'current_page' => (int) $page
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        sleep(2);
        $rules = array(
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $data = array(
                'message' => 'Validation failed',
                'data' => $validator->errors()->toArray()
            );
            return response()->json($data, 422);
        }

        $requestData = $request->all();

        $user = User::create($requestData);

        $data = array(
            'message' => "user Added Successfully !!",
            'data' => $user
        );
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        sleep(2);
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        sleep(2);
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        sleep(2);
        $rules = array(
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
        );

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            $data = array(
                'message' => 'Validation failed',
                'data' => $validator->errors()->toArray()
            );
            return response()->json($data, 422);
        }

        $requestData = $request->all();

        $requestData['password'] = bcrypt($request->password);

        $user->update($requestData);

        $data = array(
            'message' => "User updated successfully !!",
            'data' => $user
        );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        sleep(2);
        $user->delete();
        $data = array(
            'message' => "User deleted Successfully !!",
            'data' => $user
        );
        return response()->json($data, 200);
    }
}
