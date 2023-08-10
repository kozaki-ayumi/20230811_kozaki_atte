@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')


<div class="message">{{ $user->name }}　さんお疲れ様です！</div>

  @if(session('message'))
  <div class="attendance__message">
    {{session('message')}}
  </div>
  @endif


<div class="stamp__content-work">

@if(empty($stamp))
    <div class="stamp__panel">     
      <form action="/startwork" method="post">
      @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="date">
        <button class="stamp__button-submit" type="submit">勤務開始</button>
      </form>
    </div>    
@elseif($stamp['date']==date('Y-m-d'))
    <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>勤務開始</button>
    </div>  
@else
    <div class="stamp__panel">     
      <form action="/startwork" method="post">
      @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="date">
        <button class="stamp__button-submit" type="submit">勤務開始</button>
      </form>
    </div>    
@endif    

@if(empty($stamp))
    <div class="stamp__panel">
        <button class="stamp__button-submit" type="submit" disabled>勤務終了</button>
    </div>
@elseif(($stamp['date']==date('Y-m-d'))&&(empty($stamp['end_work'])))
    <div class="stamp__panel" >
      <form action="/endwork" method="post">
      @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="date">
        <button class="stamp__button-submit" type="submit" >勤務終了</button>
      </form>
    </div>
@else
    <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>勤務終了</button>
    </div>   
@endif       
</div>  

<div class="stamp__content-rest">

@if(empty($stamp))
  <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>休憩開始</button>
  </div> 
@elseif(($stamp['date']==date('Y-m-d'))&&(empty($stamp['end_work']))&&(empty($rest)))
  <div class="stamp__panel">
    <form action="/startrest" method="post">
      @csrf
       <input type="hidden" name="user_id" value="{{$user->id}}">
       <input type="hidden" name="date">
      <button class="stamp__button-submit" type="submit">休憩開始</button>
    </form>  
  </div> 
@elseif(($stamp['date']==date('Y-m-d'))&&(empty($stamp['end_work']))&&(!empty($rest['end_rest'])))
  <div class="stamp__panel">
    <form action="/startrest" method="post">
      @csrf
       <input type="hidden" name="user_id" value="{{$user->id}}">
       <input type="hidden" name="date">
      <button class="stamp__button-submit" type="submit">休憩開始</button>
    </form>  
  </div>   
@else  
  <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>休憩開始</button>
  </div>     
@endif  

@if(empty($stamp))
  <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>休憩終了</button>
  </div> 
@elseif(($stamp['date']==date('Y-m-d'))&&(empty($stamp['end_work']))&&(empty($rest)))
  <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>休憩終了</button>
  </div> 
@elseif(($stamp['date']==date('Y-m-d'))&&(empty($stamp['end_work']))&&(empty($rest['end_rest'])))
  <div class="stamp__panel">
    <form action="/endrest" method="post">
      @csrf
      <input type="hidden" name="user_id" value="{{$user->id}}">
       <input type="hidden" name="date">
      <button class="stamp__button-submit" type="submit">休憩終了</button>
    </form>  
  </div>
@else
  <div class="stamp__panel">     
        <button class="stamp__button-submit" type="submit" disabled>休憩終了</button>
  </div>  
@endif

</div>

@endsection
