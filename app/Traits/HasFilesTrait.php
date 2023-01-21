<?php

namespace App\Traits;

use App\Models\File as FileModel;
use Illuminate\Support\Facades\Storage;

trait HasFilesTrait
{
    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function bootHasFilesTrait()
    {
        static::deleted(function ($model) {
            $model->deleteFiles();
        });
    }

    /**
     * Get folder that contains files associated with the model.
     *
     * @return string
     */
    protected function getFilesFolderAttribute()
    {
        return $this->folderWithFiles ?? time() . auth()->id();
    }

    /**
     * Get files associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files()
    {
        return $this->morphMany(FileModel::class, 'fileable');
    }

    /**
     * Upload files from the request and create entry in files DB table.
     *
     * @param  array|null  $files
     * @return void
     */
    public function uploadFiles($files = null)
    {
        if (!is_null($files)) {
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $name = $this->createFileName();

                    $file->storeAs("public/{$this->filesFolder}/{$this->id}", $name . '.' . $extension);

                    $this->files()->create([
                        'name' => $name,
                        'extension' => $extension,
                        'folder' => $this->filesFolder,
                        'public_path' => url("storage/{$this->filesFolder}/{$this->id}/{$name}.{$extension}")
                    ]);
                }
            }
        }
    }

    /**
     * Create a new name for the uploaded file.
     *
     * @return string
     */
    public function createFileName()
    {
        return rand(10000, 1000000).time() . $this->id;
    }

    /**
     * Delete all files associated with the model.
     *
     * @return void
     */
    public function deleteFiles()
    {
        if ($this->files()->count() > 0) {
            $dir = "{$this->files()->value('folder')}/{$this->id}";

            if (!$this->folderWithFiles) {
                $dir = "{$this->files()->value('folder')}";
            }

            Storage::deleteDirectory("public/{$dir}");

            $this->files()->delete();
        }
    }
}
