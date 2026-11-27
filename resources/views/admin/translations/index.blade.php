@extends('layouts.admin')

@section('title', 'Languages')
@section('kicker', 'Content')
@section('heading', 'Edit languages')

@section('content')
    <div class="admin-toolbar" style="margin-bottom:14px">
        <div class="chips">
            @foreach ($locales as $code)
                <a href="{{ route('admin.translations.index', ['locale' => $code]) }}" @if ($locale === $code) aria-current="true" @endif>
                    {{ strtoupper($code) }}
                </a>
            @endforeach
        </div>
    </div>

    <form class="admin-form admin-panel" method="POST" action="{{ route('admin.translations.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="locale" value="{{ $locale }}">

        @foreach ($groups as $group => $rows)
            <details class="admin-lang-group" @if ($loop->first) open @endif>
                <summary>{{ strtoupper($group) }} <span class="admin-muted">({{ $rows->count() }})</span></summary>
                <div class="admin-form-grid" style="margin-top:12px">
                    @foreach ($rows as $row)
                        <label class="admin-field wide">
                            <span>{{ $row->key }}</span>
                            <textarea name="translations[{{ $row->key }}]" rows="2">{{ old('translations.'.$row->key, $row->value) }}</textarea>
                        </label>
                    @endforeach
                </div>
            </details>
        @endforeach

        <div class="admin-toolbar" style="margin-top:16px">
            <button class="admin-btn admin-btn-gold" type="submit">Save {{ strtoupper($locale) }}</button>
        </div>
    </form>
@endsection
