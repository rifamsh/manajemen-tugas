<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Project Assets</h5>
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
            @csrf
            <select name="task_id" class="form-select form-select-sm rounded-pill me-2" style="width: 200px;">
                <option value="">-- Tugas (opsional) --</option>
                @foreach($tasks as $t)
                    <option value="{{ $t->id }}">{{ $t->title }}</option>
                @endforeach
            </select>
            <input type="file" name="file" class="form-control form-control-sm" required>
            <button class="btn btn-primary btn-sm">Upload</button>
        </form>
    </div>
    <div class="table-responsive px-4 pb-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="text-muted small uppercase">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date Added</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($files as $f)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="far fa-file text-secondary fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold">{{ $f->file_name }}</div>
                                    @if($f->task_id)
                                        <small class="text-muted">Tugas: {{ optional($f->task)->title }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $f->file_type }}</span></td>
                        <td><span class="text-muted">{{ number_format((Storage::disk('public')->size($f->file_path) / 1024 / 1024), 2) }} MB</span></td>
                        <td><span class="text-muted">{{ $f->created_at->format('d M Y') }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('files.download', $f) }}" class="btn btn-light btn-sm"><i class="fas fa-download"></i></a>
                            <form action="{{ route('files.destroy', $f) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada file.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>