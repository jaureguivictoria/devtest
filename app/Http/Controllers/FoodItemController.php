<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFoodItemsCSVRequest;
use App\Http\Resources\FoodItemCollection;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use Illuminate\Http\JsonResponse;
use League\Csv\Reader;
use Throwable;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request()->query('per_page', 15);

        return new FoodItemCollection(FoodItem::paginate($perPage));
    }

    public function upload(UploadFoodItemsCSVRequest $request): JsonResponse
    {
        $csvFile = $request->file('file');

        $csv = Reader::createFromPath($csvFile->getRealPath());

        try {
            // Ignore header row
            $csv->setHeaderOffset(0);

            $records = $csv->getRecords();

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'The CSV could not be processed.',
                'errors' => ['file' => 'Invalid CVS Data']
            ], 422);
        }

        foreach($records as $record)
        {
            $category = FoodCategory::firstOrCreate(['name' => $record['Category']]);

            $item = new FoodItem([
                'name' => $record['Food Item'],
                'measure' => $record['Measure'],
                'calories' => floatval($record['Calories']),
                'protein' => floatval($record['Protein']),
                'fat' => floatval($record['Fat']),
                'carbs' => floatval($record['Carbs']),
                'fibre' => floatval($record['Fibre']),
            ]);

            $item->foodCategory()->associate($category);

            $item->save();
        }

        return response()->json(['message' => 'Upload successfull']);
    }
}
