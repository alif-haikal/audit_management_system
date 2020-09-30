<script type="text/javascript">
    btnCreate = (elem) => {
        confirmCreate(elem).then((result) => {
            let data = $('form').serialize();
            if (result.value) {
                let datatable = $('#permissionDatatable')
                processCreation(elem, datatable, data)
            } else {
                Swal.fire(
                    'Canceled',
                    'Process has been canceled',
                    'info'
                )
            }
        })
    }
</script>
