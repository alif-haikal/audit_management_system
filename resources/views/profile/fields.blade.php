<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $profile->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Ic</label>
    <input type="text" class="form-control" value="{{ $profile->ic ?? '' }}" placeholder="Ic" name="ic">
</div>

<div class="form-group">        
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $profile->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div>

<div class="form-group">        
    <label>Updated at</label>
    <input type="text" class="form-control" value="{{ $profile->updated_at ?? '' }}" placeholder="Updated at" name="updated_at">
</div>
