@extends('layouts.portal')
@section('pageTitle', 'Kalender Akademik')
@section('content')
<section class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm"><h3 class="text-lg font-extrabold">Agenda Akademik</h3><p class="text-sm text-slate-500 mb-5">Contoh agenda semester. Tanggal dapat disesuaikan dengan kalender resmi kampus.</p><div class="space-y-3">@foreach($events as $event)<div class="flex flex-col sm:flex-row gap-4 p-4 rounded-xl border border-slate-200"><div class="sm:w-36 flex-shrink-0"><span class="inline-block bg-orange-50 text-orange-700 rounded-xl px-3 py-2 text-sm font-extrabold">{{ \Illuminate\Support\Carbon::parse($event['tanggal'])->format('d M Y') }}</span></div><div class="flex-1"><h4 class="font-bold">{{ $event['judul'] }}</h4><p class="text-xs text-slate-500 mt-1">{{ $event['jenis'] }}</p></div></div>@endforeach</div></section>
@endsection
