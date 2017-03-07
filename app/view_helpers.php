<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 06/03/2017
 * Time: 19:21
 */

if (!function_exists('style_imported_file_state')) {
    /**
     * @param string $state
     */
    function style_imported_file_state($state)
    {
        switch ($state) {
            case \App\Business\Constants\ImportedFileState::IMPORTED:
                return sprintf('<span class="label label-primary">%s</span>', $state);
            case \App\Business\Constants\ImportedFileState::PROCESSED:
                return sprintf('<span class="label label-success">%s</span>', $state);
            case \App\Business\Constants\ImportedFileState::ERROR_PROCESSING:
                return sprintf('<span class="label label-danger">%s</span>', $state);
            case \App\Business\Constants\ImportedFileState::PROCESSING:
                return sprintf('<span class="label label-warning">%s</span>', $state);
        }
        return $state;
    }
}

if (!function_exists('style_imported_line_state')) {
    /**
     * @param string $state
     */
    function style_imported_line_state($state)
    {
        switch ($state) {
            case \App\Business\Constants\ImportedLineState::IMPORTED:
                return sprintf('<span class="label label-primary">%s</span>', $state);
            case \App\Business\Constants\ImportedLineState::PROCESSED:
                return sprintf('<span class="label label-success">%s</span>', $state);
            case \App\Business\Constants\ImportedLineState::ERROR:
                return sprintf('<span class="label label-danger">%s</span>', $state);
        }
        return $state;
    }
}

if (!function_exists('show_date_time')) {
    /**
     * @param \Carbon\Carbon|null $date
     * @param string $format
     * @return string
     */
    function show_date_time(\Carbon\Carbon $date = null, $format = 'd-m-Y H:i:s')
    {
        if ($date == null) return '';
        else return $date->format($format);
    }
}

if (!function_exists('show_date')) {
    /**
     * @param \Carbon\Carbon|null $date
     * @param string $format
     * @return string
     */
    function show_date(\Carbon\Carbon $date = null, $format = 'd-m-Y')
    {
        if ($date == null) return '';
        else return $date->format($format);
    }
}