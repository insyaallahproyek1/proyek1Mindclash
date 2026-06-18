@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    .table-container {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        overflow: hidden;
        margin-bottom: 40px;
    }

    table { width: 100%; border-collapse: collapse; }
    thead { background: rgba(139, 92, 246, 0.1); border-bottom: 2px solid rgba(139, 92, 246, 0.3); }
    th { padding: 20px; text-align: left; color: #c4b5fd; font-weight: bold; text-transform: uppercase; font-size: 12px; }
    td { padding: 18px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); color: #e2e8f0; }
    tbody tr:hover { background: rgba(139, 92, 246, 0.1); }
    
    .badge { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
    .badge.category { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
    
    .btn-action { padding: 8px 15px; border: none; border-radius: 8px; font-size: 12px; cursor: pointer; transition: all 0.3s; text-decoration: none; color: white; display: inline-block; margin-right: 5px; }
    .btn-edit { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
    .btn-edit:hover { background: #3b82f6; color: white; }
    .btn-delete { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }
    .btn-delete:hover { background: #ef4444; color: white; }
    .btn-delete-form { 
        background: none; 
        border: none; 
        padding: 8px 15px; 
        border-radius: 8px; 
        font-size: 12px; 
        cursor: pointer; 
        transition: all 0.3s; 
        color: #fca5a5;
        background: rgba(239, 68, 68, 0.2);
    }
    .btn-delete-form:hover { 
        background: #ef4444; 
        color: white; 
    }
    .btn-add { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; display: inline-block; transition: all 0.3s; }
    .btn-add:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4); color: white;}
</style>
@endpush

@section('content')

    @if (session('success'))
        <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid #22c55e; border-radius: 8px; padding: 15px; margin-bottom: 25px; color: #86efac;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 class="section-title" style="margin: 0;"><i class="fas fa-book"></i> Daftar Kategori</h3>
        <a href="/categories/create" class="btn-add"><i class="fas fa-plus"></i> Tambah Kategori Baru</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Soal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span class="badge category">{{ $category->name }}</span></td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td><strong>{{ $category->questions_count }}</strong> soal</td>
                    <td>
                        <a href="/categories/{{ $category->id }}/edit" class="btn-action btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <form action="/categories/{{ $category->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-form"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #a0aec0; padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px;"></i>
                        <div>Belum ada kategori</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
