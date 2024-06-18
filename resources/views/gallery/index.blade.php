@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3"> Tambah Data</a>
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto </th>
                                <th>Nama Kegiatan</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($gallery as $gl)
                               <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage/'. $gl->image) }}" alt="" width="50px"></td>
                                <td>{{ $gl->nama }}</td>
                                <td>{{ $gl->tahun }}</td>
                                <td>
                                   
                                    <a href="{{ route('gallery.edit', $gl->id) }}" class="badge bg-warning"><i class='bx bxs-edit-alt'></i></span></a>
                                    <form action="{{ route('gallery.destroy', $gl->id) }}" method="POST" class="d-inline" id="deleteForm">
                                    @csrf
                                    @method('delete')
                                    <button class="badge bg-danger border-0 delete-btn"><i class='bx bxs-trash'></i></button>
                                    </form>
                                </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function(){
            $('#tbl_list').DataTable();

            // Attach event listener for delete button click
            $('.delete-btn').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });

        $(document).ready(function(){
        // Check if success message exists
        var successMessage = '{{ session('success') }}';
        if(successMessage){
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
    </script>
@endsection
