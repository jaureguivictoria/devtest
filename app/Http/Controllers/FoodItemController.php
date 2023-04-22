<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFoodItemsCSVRequest;
use App\Http\Resources\FoodItemCollection;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use Illuminate\Http\Response;
use League\Csv\Reader;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FoodItemCollection(FoodItem::paginate());
    }

    public function upload(UploadFoodItemsCSVRequest $request): Response
    {
        $csvFile = $request->file('file');

        $csv = Reader::createFromPath($csvFile->getRealPath());

        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

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

        return response('Upload successfull');
    }
}
