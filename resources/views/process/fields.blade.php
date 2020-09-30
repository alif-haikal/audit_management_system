<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $process->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Process</label>
    <input type="text" class="form-control" value="{{ $process->process ?? '' }}" placeholder="Process" name="process">
</div>

<div class="form-group">        
    <label>Created by</label>
    <input type="text" class="form-control" value="{{ $process->created_by ?? '' }}" placeholder="Created by" name="created_by">
</div>

<div class="form-group">        
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $process->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div>

<div class="form-group">        
    <label>Updated at</label>
    <input type="text" class="form-control" value="{{ $process->updated_at ?? '' }}" placeholder="Updated at" name="updated_at">
</div>
