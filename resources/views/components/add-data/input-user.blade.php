<div class="col-md-6">
<form  action="{{ isset($user) ? route('add-user.update', $user->id) : route('add-user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <!-- Optional tools can be added here -->
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name', $user->name ?? '') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Select Picture</label>
                        <input class="form-control" type="file" name="image" id="formFile">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputClientCompany">Email</label>
                    <input type="email" id="inputClientCompany" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputProjectLeader">Password</label>
                    <input type="password" id="inputProjectLeader" name="password" class="form-control">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Must be 8-20 characters long.
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <!-- Optional tools can be added here -->
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputClientCompany">Birthday</label>
                    <input type="date" id="inputClientCompany" name="birthday" class="form-control" value="{{ old('birthday', $user->birthday ?? '') }}">
                    @error('birthday')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputStatus">Primary City</label>
                    <select id="inputStatus" class="form-control custom-select" name="cities_id">
                        <option value="" disabled>Select one</option>
                        @foreach ($city as $c)
                        <option value="{{ $c->id }}" {{ (isset($user) && $c->id == $user->cities_id) ? 'selected' : '' }}>
                            {{ $c->city_name }}
                        </option>
                    @endforeach

                    </select>
                    @error('cities_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('user-list.show') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($user) ? 'Update' : 'Add User' }}
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </form>
</div>
<div class="col-md-6">
    <!-- Optional additional content -->
</div>
