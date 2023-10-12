@push('custom-js')
    <script>
        $(document).on('click', '.btn-danger', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');

            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(url + '/' + encodeURI(id), {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        .then(response => {
                            // console.log(response.text());
                            if (!response.ok) {
                                // throw new Error(response.statusText)
                                return response.text().then(text => {
                                    throw new Error(text)
                                })
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(error)
                        })
                }
            }).then((result) => {
                // console.log(result);
                if (result.isConfirmed) {
                    Swal.fire(
                        'Sukses!',
                        'Data berhasil dihapus.',
                        'success'
                    )
                    return window.location.replace(url);
                }
            })
        });
    </script>
@endpush
