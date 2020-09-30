<div class="form-group">        
    <label>Permission id</label>
    <input type="text" class="form-control" value="{{ $modelhaspermission->permission_id ?? '' }}" placeholder="Permission id" name="permission_id">
</div>

<div class="form-group">        
    <label>Model type</label>
    <input type="text" class="form-control" value="{{ $modelhaspermission->model_type ?? '' }}" placeholder="Model type" name="model_type">
</div>

<div class="form-group">        
    <label>Model id</label>
    <input type="text" class="form-control" value="{{ $modelhaspermission->model_id ?? '' }}" placeholder="Model id" name="model_id">
</div>
