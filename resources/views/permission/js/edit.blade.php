<script type="text/javascript">
    btnUpdate = (elem) => {
        confirmUpdate(elem).then((result) => {
            let data = $('form').serialize();
            if (result.value) {
                let datatable = $('#permissionDatatable')
                processUpdation(elem, datatable, data)
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
