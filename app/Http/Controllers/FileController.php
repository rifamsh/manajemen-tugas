<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File as FileModel;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // Tampilkan list file milik user dan form upload
    public function index()
    {
        $user = auth()->user();

        // Ambil tugas milik user untuk dropdown (yang sudah dia kerjakan)
        $tasks = Task::where('user_id', $user->id)->orderBy('title')->get();

        // Files yang diupload oleh user
        $files = FileModel::where('user_id', $user->id)->orderByDesc('created_at')->get();

        return view('files', compact('tasks', 'files'));
    }

    // Simpan upload file
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'nullable|exists:tasks,id',
            'file' => 'required|file|max:5120',
        ]);

        $user = auth()->user();
        $uploaded = $request->file('file');

        $filename = time().'_'.preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $uploaded->getClientOriginalName());
        $path = $uploaded->storeAs('files', $filename, 'public');

        $file = FileModel::create([
            'task_id' => $request->input('task_id'),
            'user_id' => $user->id,
            'file_path' => $path,
            'file_name' => $uploaded->getClientOriginalName(),
            'file_type' => $uploaded->getClientMimeType(),
        ]);

        return back()->with('success', 'File berhasil diupload');
    }

    // Download file
    public function download(FileModel $file)
    {
        $this->authorizeAction($file);

        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($file->file_path, $file->file_name);
    }

    // Hapus file
    public function destroy(FileModel $file)
    {
        $this->authorizeAction($file);

        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return back()->with('success', 'File dihapus');
    }

    protected function authorizeAction(FileModel $file)
    {
        $user = auth()->user();
        if ($file->user_id !== $user->id) {
            abort(403);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        // Menampilkan halaman daftar file / assets
        return view('files.index');
    }
}
