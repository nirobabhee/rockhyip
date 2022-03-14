@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Hero  -->
    @include($activeTemplate. "partials.banner")
    <!-- Hero End -->
    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
