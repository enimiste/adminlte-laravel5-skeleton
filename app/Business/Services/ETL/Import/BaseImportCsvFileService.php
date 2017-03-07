<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 22:58
 */

namespace App\Business\Services\ETL\Import;


use App\Business\Assert\AssertThat;
use App\Business\Constants\ImportedFileState;
use App\Business\Contracts\BusinessInterface;
use App\Business\Contracts\TokenGeneratorInterface;
use App\Business\Exception\BusinessException;
use App\Business\Exception\BusinessImportException;
use App\Models\ImportedFile;
use App\Models\ImportedFileLog;
use Illuminate\Database\Connection;
use League\Csv\Reader;

abstract class BaseImportCsvFileService implements BusinessInterface
{
    /**
     * @var
     */
    protected $delimiter;
    /**
     * @var string
     */
    protected $inputEncoding;
    /**
     * @var Connection
     */
    protected $db;
    /**
     * @var TokenGeneratorInterface
     */
    protected $tokenGenerator;

    /**
     * BaseImportCsvFileService constructor.
     *
     * @param Connection $db
     * @param TokenGeneratorInterface $tokenGenerator
     * @param string $delimiter
     * @param string $inputEncoding
     */
    public function __construct(Connection $db,
                                TokenGeneratorInterface $tokenGenerator,
                                $delimiter = ';',
                                $inputEncoding = 'UTF-8')
    {
        $this->delimiter = $delimiter;
        $this->inputEncoding = $inputEncoding;

        AssertThat::stringNotEmpty($delimiter, 'Delimiter should not be empty');
        AssertThat::stringNotEmpty($inputEncoding, 'Input encoding should not be empty');
        $this->db = $db;
        $this->tokenGenerator = $tokenGenerator;
    }


    /**
     * Import a csv file.
     *
     * @param string $filePath
     * @param string $clientFileName
     * @param bool $withHeaders
     * @return ImportedFile
     *
     * @throws BusinessImportException
     */
    public function import($filePath, $clientFileName, $withHeaders = false)
    {
        try {
            AssertThat::stringNotEmpty($filePath, 'File path should not be empty');
            AssertThat::stringNotEmpty($clientFileName, 'File name should not be empty');
            /** @var Reader $reader */
            $reader = Reader::createFromPath($filePath, 'r');
            $reader->setDelimiter($this->delimiter);
            $reader->setInputEncoding($this->inputEncoding);

            $this->db->beginTransaction();
            try {
                /** @var  ImportedFile $file */
                $file = app(ImportedFile::class);
                $file->id = $this->tokenGenerator->nextToken();
                $file->client_file_name = $clientFileName;
                $file->accumulated_nbr_processed_lines = 0;
                $file->accumulated_nbr_lines = 0;
                $file->state = ImportedFileState::IMPORTING;
                $file->save();

                //Log
                ImportedFileLog::log($file->id, $file->state);

                $obj = $this;
                $reader
                    ->setOffset(boolval($withHeaders))//to ignore headers line
                    ->each(function (array $row, $key) use ($file, $obj) {
                        try {
                            AssertThat::greaterThanEq(count($row), 4, 'File lines should contain at least 4 columns : Idiris, echelons_ids, exported_amount, accepted_amount');

                            $obj->validateAndSaveLine($row, $key, $file->id);

                            $file->accumulated_nbr_lines++;
                        } catch (BusinessException $e) {
                            throw new BusinessException('Error at line ' . $key . ' : ' . $e->getMessage(), $e->getCode(), $e);
                        } catch (\Exception $e) {
                            throw new \Exception('Error at line ' . $key . ' : ' . $e->getMessage(), $e->getCode(), $e);
                        }

                        return true;//required by each function to continue iterating
                    });

                $file->state = ImportedFileState::IMPORTED;
                $file->save();

                //Log
                ImportedFileLog::log($file->id, $file->state);

                $this->db->commit();
                return $file->fresh();
            } catch (BusinessException $e) {
                $this->db->rollBack();
                throw $e;
            } catch (\Exception $e) {
                $this->db->rollBack();
                throw  $e;
            }
        } catch (\Exception $ex) {
            throw new BusinessImportException($filePath, $ex->getMessage(), $ex->getCode(), $ex);
        }
    }

    /**
     * Don not use transactions in this function
     *
     * @param array $row
     * @param string $rowKey
     * @param $importedFileId
     *
     * @return
     */
    abstract public function validateAndSaveLine(array $row, $rowKey, $importedFileId);
}