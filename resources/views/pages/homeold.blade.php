<form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We'll never share your email
            with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputPassword1" placeholder="Title">
    </div>
    <div class="form-group ">
        <label for="exampleInputPassword1">Body</label>
        <input type="text" name="body" class="form-control" id="exampleInputPassword1" placeholder="Body">
    </div>

    <div class="form-group ">
        {{-- <label for="exampleInputPassword1">Body</label> --}}
        <input type="file" name="file" class="form-control" id="exampleInputPassword1" placeholder="File">
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<div>
    {{-- <img src="{{ asset($pd->getFirstMediaUrl()) }}" width="full"> --}}
    {{-- @php
        $thumbnail = $pd->registeredMediaConversions($pd->getfirstMedia());
        dd($thumbnail);
    @endphp --}}

        {{-- @dd($pds) --}}

    @foreach ($pds as $pd)


    {{-- {{ $pd->getRegisteredMediaCollections() }} --}}
    {{-- {{ $pd->getUrl('thumb') }} --}}
    {{ $pd->getfirstMedia() }}


    {{-- {{ $pd->getThumbnail('thumb') }} --}}
    {{-- {{ $pd->getUrl('thumb') }} --}}
    {{-- {{ $pd->getMedia('images') }} --}}
    {{-- {{  $thumbnail =  $pd->registerMediaConversions($pd->getfirstMedia()) }} --}}
    @endforeach


{{-- <img src="{{ asset('imgs/test-2.png') }}"> --}}
    {{-- <img src="{{ $thumbnail }}"> --}}
</div>
