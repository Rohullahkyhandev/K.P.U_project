@extends('Layout._Layout')

{{-- core table componet that will use entire the system --}}
@section('content')
    <div class="mt-14 m-10">
        <div class="flex items-center justify-between">
            <div>
                <a href="" class="bg-blue-600 rounded-md py-2 px-3 hover:bg-blue-700 text-white">Some Text</a>
            </div>
            <div>Text Will Come Here</div>
        </div>

        <div class="bg-white shadow rounded-lg py-8 mt-4">
            <div>
                <div class="flex items-center justify-between px-10">
                    <div>
                        <input type="text" class="border rounded border-gray-200 shadow" placeholder="جستجو بر اساس">
                    </div>
                    <div>
                        <select name="" id="" class="border rounded border-gray-200 shadow">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-10 mt-4">
                    <table class="table-auto w-full">
                        <thead class="w-full bg-gray-300 border-t-2 border-b-2 border-gray-800 h-10">
                            <tr>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                                <th>شماره</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                                <td class="border-b border-gray-400 py-3">1</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>

                    <div class="flex items-center justify-between px-10">
                        <div>
                            <p>Pagination</p>
                        </div>
                        <div>
                            <p> Showing Data Form 1 to 1000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
{{-- end of the core table  --}}
