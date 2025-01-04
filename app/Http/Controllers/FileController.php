<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Resources\FileResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class FileController extends Controller
{
    public function myFiles(string $folder = null)
    {
        // Debugging: Check the authenticated user ID and folder parameter
        // \Log::info('Auth ID: ' . Auth::id());
        // \Log::info('Folder: ' . $folder);

        if ($folder) {
            // Ensure the folder path starts with a leading slash
            // if ($folder[0] !== '/') {
            //     $folder = '/' . $folder;
            // }

            $folder = File::query()
                ->where('created_by', Auth::id())
                ->where('path', $folder)
                ->firstOrFail();
            // \Log::info('Folder Query Result: ' . json_encode($folder));
        }
        // dd($folder);

        // // dd(File::all()->pluck('path'));
        if (!$folder) {
            $folder = $this->getRoot();
        }
        // $folder = $this->getRoot();
        $files = File::query()
            ->where('parent_id', $folder->id)
            ->where('created_by', Auth::id())
            ->orderBy('is_folder', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $files = FileResource::collection($files);

        return Inertia::render('MyFiles', compact('files', 'folder'));
    }

    public function createFolder(StoreFolderRequest $request)
    {
        // dd(Auth::id());
        $data = $request->validated();
        $parent = $request->parent_id ? File::find($request->parent_id) : $this->getRoot();
        // dd($parent, $data);  


        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];
        $file->created_by = Auth::id();
        $parent->appendNode($file);
    }

    private function getRoot()
    {
        return File::query()->whereIsRoot()->where('created_by', Auth::id())->firstOrFail();
    }
}