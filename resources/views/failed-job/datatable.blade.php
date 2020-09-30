<table id="failedJobDatatable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
			<th>Connection</th>
			<th>Queue</th>
			<th>Payload</th>
			<th>Exception</th>
			<th>Failed at</th>
			<th>Actions</th>            
        </tr>
    </thead>
    <tbody>
        <!-- -->
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
			<th>Connection</th>
			<th>Queue</th>
			<th>Payload</th>
			<th>Exception</th>
			<th>Failed at</th>
			<th>Actions</th>            
        </tr>
    </tfoot>
</table>

@push('scripts')

@include('failed-job/js/datatable')

@endpush

