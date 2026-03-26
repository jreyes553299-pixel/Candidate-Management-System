<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $candidates = Candidate::when($search, function ($query, $search) {
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%")
                ->orWhere('party', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->get();

        return view('candidates.index', compact('candidates', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'party' => 'nullable|string|max:255',
        ]);

        Candidate::create($request->all());

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }

    public function edit(Candidate $candidate)
    {
        return view('candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'party' => 'nullable|string|max:255',
        ]);

        $candidate->update($request->all());

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
