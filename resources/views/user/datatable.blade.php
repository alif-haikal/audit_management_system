<table id="userDatatable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>Created at</th>
			<th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- -->
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>Created at</th>
			<th>Actions</th>
        </tr>
    </tfoot>
</table>

@push('scripts')

@include('user/js/datatable')

@endpush

