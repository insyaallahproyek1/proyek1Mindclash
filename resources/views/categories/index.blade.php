<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Categories - MindClash</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body{
    background:#0f172a;
    color:white;
    font-family:Arial;
}
.container{
    margin-top:50px;
}
.card{
    background:#1e293b;
    border:none;
    border-radius:20px;
    padding:20px;
}
.table{
    color:white;
}
.btn-primary{
    background:#7c3aed;
    border:none;
}
.btn-primary:hover{
    background:#8b5cf6;
}
h2{
    font-weight:bold;
}
</style>
</head>
<body>

<div class="container">
<div class="card">
<div class="d-flex justify-content-between align-items-center mb-4">
<h2>Category Management</h2>
<a href="{{ route('categories.create') }}" class="btn btn-primary">+ Add Category</a>
</div>

@if ($message = session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<table id="categoryTable" class="table table-dark table-hover">
<thead>
<tr>
<th>No</th>
<th>Name</th>
<th>Description</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@forelse ($categories as $key => $category)
<tr>
<td>{{ $key + 1 }}</td>
<td>{{ $category->name }}</td>
<td>{{ $category->description ?? '-' }}</td>
<td>
<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
<button class="btn btn-danger btn-sm delete-btn" data-id="{{ $category->id }}">Delete</button>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center">No categories found</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>

<script>
$(document).ready(function(){
    $('.delete-btn').click(function(){
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Category?',
            text: 'Data cannot be restored!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#7c3aed',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if(result.isConfirmed){
                let token = '{{ csrf_token() }}';
                fetch(`/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                });
            }
        });
    });
});
</script>

</body>
</html>
