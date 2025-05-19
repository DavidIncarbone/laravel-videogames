@if($errors->any())

<div class="alert alert-danger" role="alert">Si sono verificati i seguenti errori:

    <ul>

@foreach($errors->messages() as $field => $messages)
        @foreach($messages as $message)

        <li>{{$message}}</li>
           @endforeach
@endforeach

</ul>

</div>

@endif 