<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with('user')->get();
        return view('pages.visitors.index', compact('visitors'));
    }

    public function create()
    {
        $memberRole = Role::where('name', 'Member')->first();
        $users = $memberRole ? $memberRole->users : collect();
        return view('pages.visitors.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::with('role')->find($request->user_id);
        if ($user->role->name !== 'Member') {
            return redirect()->route('visitors.create')->withErrors(['user_id' => 'Selected user is not a member.']);
        }

        Visitor::create($request->all());

        return redirect()->route('visitors.index')->with('success', 'Visitor created successfully.');
    }

    public function edit($id)
    {
        $visitor = Visitor::findOrFail($id);
        $memberRole = Role::where('name', 'Member')->first();
        $users = $memberRole ? $memberRole->users : collect();
        return view('pages.visitors.edit', compact('visitor', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::with('role')->find($request->user_id);
        if ($user->role->name !== 'Member') {
            return redirect()->route('visitors.edit', $id)->withErrors(['user_id' => 'Selected user is not a member.']);
        }

        $visitor = Visitor::findOrFail($id);
        $visitor->update($request->all());

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }
}
