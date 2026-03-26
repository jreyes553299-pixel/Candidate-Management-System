<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Management System</title>
    <link rel="stylesheet" href="{{ asset('css/candidates.css') }}">
</head>
<body>
    <div class="container">
        <h1>Candidate Management System</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('candidates.index') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search by name, position, or party..." value="{{ $search ?? '' }}">
            <button type="submit">Search</button>
            @if($search)
                <a href="{{ route('candidates.index') }}">Clear</a>
            @endif
        </form>

        <div class="card">
            <h2>Add Candidate</h2>
            <form action="{{ route('candidates.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                        @error('middle_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select id="gender" name="gender" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Position *</label>
                        <input type="text" id="position" name="position" value="{{ old('position') }}" required>
                        @error('position') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="party">Party</label>
                        <input type="text" id="party" name="party" value="{{ old('party') }}">
                        @error('party') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-add">Add Candidate</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <h2>Candidate List</h2>
            @if($candidates->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Position</th>
                                <th>Party</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $index => $candidate)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $candidate->first_name }}</td>
                                    <td>{{ $candidate->middle_name ?? '-' }}</td>
                                    <td>{{ $candidate->last_name }}</td>
                                    <td>{{ $candidate->gender }}</td>
                                    <td>{{ $candidate->address }}</td>
                                    <td>{{ $candidate->position }}</td>
                                    <td>{{ $candidate->party ?? '-' }}</td>
                                    <td class="actions">
                                        <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn-edit">Edit</a>
                                        <a href="{{ route('candidates.delete', $candidate->id) }}" class="btn-delete" onclick="return confirm('Are you sure you want to delete this candidate?');">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="no-data">No candidates found.</p>
            @endif
        </div>
    </div>
</body>
</html>
