@extends('layouts.admin')

@section('page_title', 'Manajemen Soal - MindClash')

@section('title')
    <i class="fas fa-question-circle"></i> Manajemen Soal
@endsection

@push('styles')
<style>
    .card-box {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 15px;
        padding: 25px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
        margin-bottom: 25px;
        transition: all 0.3s;
    }
    
    .card-box:hover {
        border-color: #8b5cf6;
    }

    .muted {
        color: #94a3b8;
    }

    .q-title {
        color: #e2e8f0;
        margin-bottom: 10px;
        font-weight: 700;
        font-size: 18px;
    }

    .options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 15px;
    }

    .opt {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 14px;
        color: #e2e8f0;
        transition: all 0.3s;
    }
    
    .opt.correct {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.1);
        color: #86efac;
    }

    .badge-cat {
        background: rgba(139, 92, 246, 0.2);
        color: #c4b5fd;
        border: 1px solid rgba(139, 92, 246, 0.4);
    }

    .btn-add {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-edit {
        background: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.4);
    }
    
    .btn-edit:hover {
        background: #3b82f6;
        color: white;
    }
    
    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.4);
    }
    
    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }
</style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <div class="muted">Total: <strong>{{ $questions->count() }}</strong> soal terdaftar</div>
        </div>
        <a href="{{ route('questions.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah Soal</a>
    </div>

    @if ($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #86efac;">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: invert(1);"></button>
    </div>
    @endif

    @forelse ($questions as $question)
    <div class="card-box">
        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <div class="q-title">
                    {{ $question->question_text }}
                </div>
                <div class="muted mb-3" style="font-size: 13px;">
                    Kategori: <span class="badge rounded-pill badge-cat px-3 py-2">{{ $question->category->name ?? '-' }}</span>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('questions.edit', $question->id) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i> Edit</a>
                <button class="btn-action btn-delete delete-btn" data-id="{{ $question->id }}"><i class="fas fa-trash"></i> Hapus</button>
            </div>
        </div>

        <div class="options">
            <div class="opt {{ $question->correct_answer === 'A' ? 'correct' : '' }}">A: {{ $question->option_a }}</div>
            <div class="opt {{ $question->correct_answer === 'B' ? 'correct' : '' }}">B: {{ $question->option_b }}</div>
            <div class="opt {{ $question->correct_answer === 'C' ? 'correct' : '' }}">C: {{ $question->option_c }}</div>
            <div class="opt {{ $question->correct_answer === 'D' ? 'correct' : '' }}">D: {{ $question->option_d }}</div>
        </div>

        <div class="mt-3 muted" style="font-size: 14px;">
            Kunci Jawaban: <span class="badge bg-success text-white px-2 py-1">{{ $question->correct_answer }}</span>
        </div>
    </div>
    @empty
    <div class="card-box text-center py-5">
        <i class="fas fa-inbox muted mb-3" style="font-size: 48px;"></i>
        <div class="muted">Belum ada soal yang ditambahkan.</div>
    </div>
    @endforelse
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
                let token = '{{ csrf_token() }}';
                fetch(`/questions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(() => location.reload())
                .catch(e => alert('Error: ' + e));
            }
        });
    });
});
</script>
@endpush
