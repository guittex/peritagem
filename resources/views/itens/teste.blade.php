@extends('layouts.app')

@section('content')

<?php


$x = array('aaa', 'ttt', 'www', 'aaa', 'tttt');

$y = array_count_values($x);

echo $y['ttt'];
?>

@endsection