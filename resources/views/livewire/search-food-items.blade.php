<div>
    <input type="text" wire:model="search" placeholder="Search food items..."/>

    <table>
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
</div>
