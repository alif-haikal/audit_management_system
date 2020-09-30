<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $activity->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Perkara</label>
    <input type="text" class="form-control" value="{{ $activity->perkara ?? '' }}" placeholder="Perkara" name="perkara">
</div>

<div class="form-group">        
    <label>Perancangan</label>
    <input type="text" class="form-control" value="{{ $activity->perancangan ?? '' }}" placeholder="Perancangan" name="perancangan">
</div>

<div class="form-group">        
    <label>Perlaksanaan</label>
    <input type="text" class="form-control" value="{{ $activity->perlaksanaan ?? '' }}" placeholder="Perlaksanaan" name="perlaksanaan">
</div>

<div class="form-group">        
    <label>Created by</label>
    <input type="text" class="form-control" value="{{ $activity->created_by ?? '' }}" placeholder="Created by" name="created_by">
</div>

<div class="form-group">        
    <label>Created at</label>
    <input type="text" class="form-control" value="{{ $activity->created_at ?? '' }}" placeholder="Created at" name="created_at">
</div>

<div class="form-group">        
    <label>Updated at</label>
    <input type="text" class="form-control" value="{{ $activity->updated_at ?? '' }}" placeholder="Updated at" name="updated_at">
</div>
