<?php

namespace App\Http\Controllers;

use HalfShellStudios\CsvConverter\Constants\ActionAttribute;
use HalfShellStudios\CsvConverter\Constants\Rule;
use HalfShellStudios\CsvConverter\Facade\CSV;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CsvController extends Controller
{
    public function index()
    {
        $ruleTypes = [
            basename(str_replace('\\', '/', Rule::CONTAINS_RULE)),
            basename(str_replace('\\', '/', Rule::EQUAL_TO_RULE)),
            basename(str_replace('\\', '/', Rule::GREATER_THAN_RULE)),
            basename(str_replace('\\', '/', Rule::GREATER_THAN_OR_EQUAL_TO_RULE)),
            basename(str_replace('\\', '/', Rule::LESS_THAN_RULE)),
            basename(str_replace('\\', '/', Rule::LESS_THAN_OR_EQUAL_TO_RULE))
        ];

        $actionAttributeTypes = [
            basename(str_replace('\\', '/', ActionAttribute::PARTIAL_FIND_AND_REPLACE_ACTION_ATTRIBUTE)),
            basename(str_replace('\\', '/', ActionAttribute::FULL_FIND_AND_REPLACE_ACTION_ATTRIBUTE)),
            basename(str_replace('\\', '/', ActionAttribute::FIND_AND_PREPEND_ACTION_ATTRIBUTE)),
            basename(str_replace('\\', '/', ActionAttribute::FIND_AND_APPEND_ACTION_ATTRIBUTE)),
        ];

        return Inertia::render('Welcome', [
            'ruleTypes' => $ruleTypes,
            'actionAttributeTypes' => $actionAttributeTypes
        ]);
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads');

        $data = CSV::parseFile(storage_path('app/' . $path));

        return response()->json([
            'headers' => $data->getHeader(),
            'records' => $data->getRecords(),
            'count' => $data->getRecordCount(),
            'csvFilePath' => storage_path('app/' . $path),
        ]);
    }

    public function downloadCSV(Request $request)
    {
        $request->validate([
            'rules' => 'nullable|array',
            'actionAttributes' => 'required|array',
            'csvFilePath' => 'required|string'
        ]);

        $rules = $request->input('rules');
        $actionAttributes = $request->input('actionAttributes');
        $csvFilePath = $request->input('csvFilePath');

        $csv = CSV::parseFile($csvFilePath);

        $formattedRules = [];
        foreach ($rules as $rule) {
            $formattedRules[] = [
                'type' => "HalfShellStudios\CsvConverter\Rules\\" . $rule['type'],
                'field' => $rule['field'],
                'value' => $rule['value']
            ];
        }

        $formattedActionAttributes = [];
        foreach ($actionAttributes as $actionAttribute) {
            $formattedActionAttributes[] = [
                'type' => "HalfShellStudios\CsvConverter\ActionAttributes\\" . $actionAttribute['type'],
                'field' => $actionAttribute['field'],
                'find' => $actionAttribute['find'],
                'replace' => $actionAttribute['replace']
            ];
        }

        $csv->importFromArray([
            'rules' => $formattedRules,
            'action_attributes' => $formattedActionAttributes
        ]);

        $csv->adjust();

        header('Content-Disposition: attachment; filename="export.csv"');
        header("Cache-control: private");
        header("Content-type: application/force-download");
        header("Content-transfer-encoding: binary\n");

        echo $csv->adjust()->toString();;
        exit;
    }

}
