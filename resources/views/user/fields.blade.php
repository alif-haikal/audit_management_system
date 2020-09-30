

<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" value="{{ $user->name ?? '' }}" placeholder="Name" name="name">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" value="{{ $user->email ?? '' }}" placeholder="Email" name="email">
</div>

<div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" value="{{ $user->password ?? '' }}" placeholder="Password" name="password">
</div>


<div class="form-group">
    <label>User Role</label>
    <select class="form-control" id="property_id" onchange="getBlocks(this)">
        <option></option>
        @foreach($roles as $role)
        <option value="{{ $property->id }}">{{ $property->name }}</option>
        @endforeach
    </select>
</div>


{{-- <div class="form-group">
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $user->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div> --}}
