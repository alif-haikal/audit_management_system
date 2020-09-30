<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $permission->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Name</label>
    <input type="text" class="form-control" value="{{ $permission->name ?? '' }}" placeholder="Name" name="name">
</div>

<div class="form-group">        
    <label>Guard name</label>
    <input type="text" class="form-control" value="{{ $permission->guard_name ?? '' }}" placeholder="Guard name" name="guard_name">
</div>

<div class="form-group">        
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $permission->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div>

<div class="form-group">        
    <label>Updated at</label>
    <input type="text" class="form-control" value="{{ $permission->updated_at ?? '' }}" placeholder="Updated at" name="updated_at">
</div>
