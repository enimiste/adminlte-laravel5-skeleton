<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 10/03/2017
 * Time: 12:20
 */

namespace App\Business\Services\ETL\Export;


use App\Business\Assert\AssertThat;
use App\Business\Exception\BusinessExportException;
use Illuminate\Support\Collection;
use League\Csv\Writer;

abstract class BaseExportCsvFile
{

    /**
     * @param Collection $coll
     * @param string $fileName
     * @return string the absolute file path
     * @throws BusinessExportException
     */
    public function exportToTmpFile(Collection $coll, $fileName)
    {
        AssertThat::stringNotEmpty($fileName, 'File name should not be empty');
        try {
            $tmpFilePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $fileName;
            /** @var Writer $writer */
            $writer = Writer::createFromPath($tmpFilePath, 'w');
            $writer->setDelimiter($this->getDelimiter());
            $columns = $this->getColumnsHeader();
            $columnsMapping = $this->getColumnsMapping();
            $writer->insertOne($columns);
            $writer->insertAll($coll->map(function ($e) use ($columnsMapping) {
                $data = [];
                foreach ($columnsMapping as $key => $map) {
                    if (is_callable($map)) {
                        $data[$key] = call_user_func($map, $data, $e);
                    } elseif (is_array($map)) {
                        if (ends_with($key, '()')) {
                            $methodName = str_replace('()', '', $key);
                            $q = call_user_func([$e, $methodName]);
                            if (str_contains($methodName, 'Query'))
                                $obj = $q->first();
                            else
                                $obj = $q;
                        } else
                            $obj = $e->$key;

                        foreach ($map as $sk => $sv) {
                            if (is_string($sk)) {
                                $data[$sv] = $obj->$sk;
                            } else {
                                $data[$sv] = $obj->$sv;
                            }
                        }
                    } elseif (is_string($key)) {
                        $data[$map] = $e->$key;
                    } else {
                        $data[$map] = $e->$map;
                    }
                }
                dd($data);
                return array_values($data);
            }));
            return $tmpFilePath;
        } catch (\Exception $e) {
            throw new BusinessExportException([], $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return string
     */
    public function getTmpDirectory()
    {
        return sys_get_temp_dir();
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return ';';
    }

    /**
     * @return array of strings
     */
    abstract public function getColumnsHeader();

    /**
     * The keys must :
     *     - Much the exported object class attributes name
     *     - Or the exported object class methods name in case you want to fetch the inner data
     *
     * The array contains one or many columns mapping. The key is the column name and the value has many formats :
     *  - [ 'attr'] : the col value will be used to fetch the value from the object
     *  - [ 'attr' => 'another name'] : Same as the first form, but the key in the $arr will be the 'another name'
     *  - [ 'methodName()' => [ 'attr1', 'attr2']] : same as the second format but here
     *       the service apply will call the methodName() on the object and fetch data using the attr1, attr2, ...
     *  - [ 'methodName()' => [ 'attr1'=>'another name', 'attr2' => 'another name 2]]
     *  - ['methodNameQuery()' => [ 'attr1', 'attr2']] : same as the third format but here
     *       the service apply will call the the function first() on the result of the second form
     *       and fetch data using the attr1, attr2, ...
     *  - ['attr' => function(array $arr, $obj) { return $v; }] : this one is used to define new column in tha output file
     *       that not exist in the object. You can access the processed attr via the $arr with its keys or access the base object.
     *
     *     NB : The order is important. It has access on values defined above
     *     The 'attr'=>'another name' is useful to avoid overriding data when the base object has the same attr name as the
     *     inner object mapped with 'attr'=>['attr1', ...]
     *
     * @return array of mapping
     */
    abstract public function getColumnsMapping();
}