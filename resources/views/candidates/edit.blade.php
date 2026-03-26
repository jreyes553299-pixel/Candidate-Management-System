<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate</title>
    <link rel="stylesheet" href="{{ asset('css/candidates.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Candidate</h1>

        <div class="card">
            <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $candidate->first_name) }}" required>
                        @error('first_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $candidate->middle_name) }}">
                        @error('middle_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $candidate->last_name) }}" required>
                        @error('last_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select id="gender" name="gender" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male" {{ old('gender', $candidate->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $candidate->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $candidate->address) }}" required>
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Position *</label>
                        <input type="text" id="position" name="position" value="{{ old('position', $candidate->position) }}" required>
                        @error('position') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="party">Party</label>
                        <input type="text" id="party" name="party" value="{{ old('party', $candidate->party) }}">
                        @error('party') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-actions-edit">
                        <button type="submit" class="btn-save">Update Candidate</button>
                        <a href="{{ route('candidates.index') }}" class="btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
