<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Business\Constants\ImportedFileState;
use App\Business\Exception\BusinessException;

class ImportedFile extends Model
{
    public $incrementing = false;

     protected $keyType = 'string';

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(ImportedFileLog::class, 'imported_file_id', 'id');
    }

    /**
     * @return bool
     */
    public function isImported()
    {
        return $this->state == ImportedFileState::IMPORTED;
    }

    /**
     * @param $newState
     */
    public function updateState($newState)
    {
        if (!(new ImportedFileState)->isValid($newState)) {
            throw new BusinessException('Invalid state ' . $newState);
        }

        $this->state = $newState;
        $this->save();
        ImportedFileLog::log($this->id, $newState);
    }
}
