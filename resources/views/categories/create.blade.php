

<!DOCTYPE html>
<html>
<head>

<title>Create Category</title>

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

</style>

</head>
<body>

<div class="container">

<div class="card p-4">

<h2 class="mb-4">
Add Category
</h2>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <input type="text" name="name" class="form-control mb-3 @error('name') is-invalid @enderror"
           placeholder="Category Name" value="{{ old('name') }}" required>
    @error('name')
    <span class="invalid-feedback d-block">{{ $message }}</span>
    @enderror

    <textarea name="description" class="form-control mb-3" placeholder="Description">{{ old('description') }}</textarea>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Save Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>

</div>

</div>

</body>
</html>
