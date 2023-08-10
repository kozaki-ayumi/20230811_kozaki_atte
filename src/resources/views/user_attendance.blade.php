@extends('layouts.app')

@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
@endsection

@section('content')

<?php $user = Auth::user(); ?>
<div class="name">{{ $user->name }}さん</div>

<table class="attendance__table" cellpadding="15">
    <tr class="table__title">
      <th>日付</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>

    @foreach($stamps as $stamp)
    <tr>
      <td class="table__item-name">{{$stamp['date']}}</td>
      <td class="table__item-startwork">{{$stamp['start_work']}}</td>
      <td class="table__item-endwork">{{$stamp['end_work']}}</td>
      <td class="table__item-totalrest">{{$stamp['totaltime_rest']}}</td>
      <td class="table__item-totalwork">{{$stamp['totaltime_work']}}</td>
    </tr>
    @endforeach
</table>

<div class="pagenate">
    <div>{{ $stamps->appends(request()->input())->links('pagination::bootstrap-4') }}</div>
</div>

@endsection










