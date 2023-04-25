<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFoodItemsCSVRequest;
use App\Http\Resources\FoodItemCollection;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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

            DB::beginTransaction();

            // Ignore header row
            $csv->setHeaderOffset(0);

            $records = $csv->getRecords();

            foreach($records as $record)
            {
                $foodItemValues = array_values($record);

                $category = FoodCategory::firstOrCreate(['name' => $foodItemValues[0]]);

                $item = new FoodItem([
                    'name' => $foodItemValues[1],
                    'measure' => $foodItemValues[2],
                    'calories' => floatval($foodItemValues[3]),
                    'protein' => floatval($foodItemValues[4]),
                    'fat' => floatval($foodItemValues[5]),
                    'carbs' => floatval($foodItemValues[6]),
                    'fibre' => floatval($foodItemValues[7]),
                ]);

                $item->foodCategory()->associate($category);

                $item->save();
            }

        } catch (Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'The CSV could not be processed.',
                'errors' => ['file' => 'Invalid CVS Data']
            ], 422);
        }

        DB::commit();

        return response()->json(['message' => 'Upload successfull']);
    }
}
