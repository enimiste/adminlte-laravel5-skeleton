<?php

namespace App\Models;

use App\Business\Constants\ImportedFileState;
use App\Business\Constants\LoggableTypes;
use App\Business\Exception\BusinessException;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ImportedFile
 *
 */
class ImportedFile extends Model
{
    const CLIENT_FILES = 'CLIENT';
    const PAIEMENT_FILES = 'PAIEMENT';
    const SIMULATED_FILES_PREFIX = 'Simulated By System';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'simulated_file' => 'boolean'
    ];

    /**
     * @return $this
     */
    public static function clientFilesQuery()
    {
        return self::where('importable_type', '=', self::CLIENT_FILES);
    }

    /**
     * @return $this
     */
    public static function paiementFilesQuery()
    {
        return self::where('importable_type', '=', self::PAIEMENT_FILES);
    }

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

    /**
     * @return $this
     */
    public function consoleLogsQuery()
    {
        return ConsoleLog::where('loggable_type', '=', LoggableTypes::IMPORTED_CLIENT_FILE)
            ->where('loggable_id', '=', $this->id)
            ->orderBy('created_at', 'desc');
    }

    /**
     * @return bool
     */
    public function isProcessed()
    {
        return $this->state == ImportedFileState::PROCESSED;
    }

    /**
     * @return bool
     */
    public function isWaitingForProcess()
    {
        return $this->state == ImportedFileState::WAITING_FOR_PROCESS;
    }

    /**
     * @return $this
     */
    public static function simulatedFilesQuery()
    {
        return self::where('simulated_file', '=', true);
    }

    /**
     * @return bool
     */
    public function canDeleteThisFile()
    {
        return $this->accumulated_nbr_lines == 0 Or $this->state == ImportedFileState::IMPORTED;
    }
}
