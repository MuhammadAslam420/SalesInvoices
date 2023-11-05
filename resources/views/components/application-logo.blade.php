@php
$setting = DB::table('settings')->first();
@endphp
<img src="{{asset('images')}}/{{$setting->logo}}" width="120" alt="">
