<div>
    <label class="relative block">
        <span class="sr-only">Search</span>
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
          <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20"><!-- ... --></svg>
        </span>
        <input  wire:model="search" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search by name" type="text" name="search" id="search"/>
      </label>

    <table class="table-fixed mt-6">
        <thead>
            <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Measure</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Fat</th>
                <th>Carbs</th>
                <th>Fibre</th>
            </tr>
        </thead>
        <tbody>
            </tr>
            @foreach($foodItems as $foodItem)
            <tr>
                <td>{{ $foodItem->foodCategory->name }}</td>
                <td>{{ $foodItem->name }}</td>
                <td>{{ $foodItem->measure }}</td>
                <td>{{ $foodItem->calories }}</td>
                <td>{{ $foodItem->protein }}</td>
                <td>{{ $foodItem->fat }}</td>
                <td>{{ $foodItem->carbs }}</td>
                <td>{{ $foodItem->fibre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $foodItems->links() }}
</div>
