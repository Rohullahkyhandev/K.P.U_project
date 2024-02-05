@extends('Layout._Layout')

@section('content')
    <div>
        <form action="{{ route('uploadFile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <br><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="container">

        {{-- <ul>
            @foreach ($data as $item)
                <li>{{ $item->Name }}</li>
            @endforeach
        </ul> --}}

    </div>
@endsection
