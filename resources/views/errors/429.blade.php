@extends('errors::minimal')

@section('title', __('errors.too_many_request'))
@section('code', '429')
@section('message', __('errors.too_many_request'))
