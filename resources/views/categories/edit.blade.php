<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Category - MindClash</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background:#0f172a;
    color:white;
}
.card{
    background:#1e293b;
    border:none;
    border-radius:20px;
}
.container{
    margin-top:80px;
    max-width:700px;
}
.btn-primary{
    background:#7c3aed;
    border:none;
}
.btn-primary:hover{
    background:#8b5cf6;
}
.form-control{
    background:#0f172a;
    border:1px solid #475569;
    color:white;
}
.form-control:focus{
    background:#0f172a;
    border-color:#7c3aed;
    color:white;
    box-shadow:0 0 0 0.2rem rgba(124, 58, 237, 0.25);
}
</style>
</head>
<body>

<div class="container">
<div class="card p-4">
<h2 class="mb-4">Edit Category</h2>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" class="form-control mb-3 @error('name') is-invalid @enderror"
           placeholder="Category Name" value="{{ old('name', $category->name) }}" required>
    @error('name')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <textarea name="description" class="form-control mb-3" placeholder="Description">{{ old('description', $category->description) }}</textarea>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
</div>
</div>

</body>
</html>
