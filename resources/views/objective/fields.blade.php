<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $objective->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Objective</label>
    <input type="text" class="form-control" value="{{ $objective->objective ?? '' }}" placeholder="Objective" name="objective">
</div>

<div class="form-group">        
    <label>Created by</label>
    <input type="text" class="form-control" value="{{ $objective->created_by ?? '' }}" placeholder="Created by" name="created_by">
</div>

<div class="form-group">        
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $objective->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div>

<div class="form-group">        
    <label>Updated at</label>
    <input type="text" class="form-control" value="{{ $objective->updated_at ?? '' }}" placeholder="Updated at" name="updated_at">
</div>
