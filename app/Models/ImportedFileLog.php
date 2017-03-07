<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportedFileLog extends Model
{
    public $incrementing = true;
    
    /**
     * @param string $importedFileId
     * @param string $state
     */
    public static function log($importedFileId, $state)
    {
        /** @var ImportedFileLog $log */
        $log = app(ImportedFileLog::class);

        $log->imported_file_id = $importedFileId;
        $log->state = $state;
        $log->save();
    }
}
