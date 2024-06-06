<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->get();
        return view('pages.members.index', compact('members'));
    }

    public function create()
    {
        $users = User::where('role_id', 3)->get(); // Fetch users with role_id 3 (Member)
        return view('pages.members.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Member created successfully');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $users = User::where('role_id', 3)->get(); // Fetch users with role_id 3 (Member)
        return view('pages.members.edit', compact('member', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $member = Member::findOrFail($id);
        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }
}
