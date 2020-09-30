<div class="form-group">        
    <label>Id</label>
    <input type="text" class="form-control" value="{{ $failedjob->id ?? '' }}" placeholder="Id" name="id">
</div>

<div class="form-group">        
    <label>Connection</label>
    <input type="text" class="form-control" value="{{ $failedjob->connection ?? '' }}" placeholder="Connection" name="connection">
</div>

<div class="form-group">        
    <label>Queue</label>
    <input type="text" class="form-control" value="{{ $failedjob->queue ?? '' }}" placeholder="Queue" name="queue">
</div>

<div class="form-group">        
    <label>Payload</label>
    <input type="text" class="form-control" value="{{ $failedjob->payload ?? '' }}" placeholder="Payload" name="payload">
</div>

<div class="form-group">        
    <label>Exception</label>
    <input type="text" class="form-control" value="{{ $failedjob->exception ?? '' }}" placeholder="Exception" name="exception">
</div>

<div class="form-group">        
    <label>Failed at</label>
    <input type="text" class="form-control" value="{{ $failedjob->failed_at ?? '' }}" placeholder="Failed at" name="failed_at">
</div>
