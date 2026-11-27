@extends('layouts.admin')

@section('title', 'Settings')
@section('kicker', 'Site')
@section('heading', 'Site settings')

@section('content')
    <form class="admin-form admin-panel" method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <h2 class="admin-subhead">General</h2>
        <div class="admin-form-grid">
            <label class="admin-field wide">
                <span>Motto</span>
                <input name="motto" value="{{ old('motto', $motto) }}" required>
            </label>
            <label class="admin-field">
                <span>Explore URL</span>
                <input type="url" name="explore_url" value="{{ old('explore_url', $explore_url) }}" required>
            </label>
            <label class="admin-field">
                <span>Telegram URL</span>
                <input type="url" name="telegram_url" value="{{ old('telegram_url', $telegram_url) }}" required>
            </label>
        </div>

        <h2 class="admin-subhead">Social links</h2>
        <div class="admin-form-grid">
            @foreach ($socials as $index => $social)
                <label class="admin-field">
                    <span>Label</span>
                    <input name="socials[{{ $index }}][label]" value="{{ old("socials.$index.label", $social['label']) }}" required>
                </label>
                <label class="admin-field">
                    <span>URL (optional)</span>
                    <input type="url" name="socials[{{ $index }}][url]" value="{{ old("socials.$index.url", $social['url']) }}" placeholder="https://">
                </label>
            @endforeach
        </div>

        <h2 class="admin-subhead">Business services</h2>
        @foreach ($services as $key => $service)
            <div class="admin-form-grid" style="margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid rgba(244,240,239,0.1)">
                <p class="admin-muted wide" style="grid-column:1/-1;margin:0">{{ $key }}</p>
                <label class="admin-field">
                    <span>Title</span>
                    <input name="services[{{ $key }}][title]" value="{{ old("services.$key.title", $service['title']) }}" required>
                </label>
                <label class="admin-field wide">
                    <span>Text</span>
                    <textarea name="services[{{ $key }}][text]" rows="2" required>{{ old("services.$key.text", $service['text']) }}</textarea>
                </label>
            </div>
        @endforeach

        <h2 class="admin-subhead">FAQ</h2>
        @foreach ($faq as $index => $item)
            <div class="admin-form-grid" style="margin-bottom:14px;padding:12px;border:1px solid rgba(244,240,239,0.1);border-radius:12px">
                <p class="admin-muted wide" style="grid-column:1/-1;margin:0">Question {{ $index + 1 }}</p>
                <label class="admin-field wide">
                    <span>EN question</span>
                    <input name="faq[{{ $index }}][en_q]" value="{{ old("faq.$index.en_q", $item['en_q']) }}" required>
                </label>
                <label class="admin-field wide">
                    <span>EN answer</span>
                    <textarea name="faq[{{ $index }}][en_a]" rows="3" required>{{ old("faq.$index.en_a", $item['en_a']) }}</textarea>
                </label>
                <label class="admin-field wide">
                    <span>MY question</span>
                    <input name="faq[{{ $index }}][my_q]" value="{{ old("faq.$index.my_q", $item['my_q']) }}" required>
                </label>
                <label class="admin-field wide">
                    <span>MY answer</span>
                    <textarea name="faq[{{ $index }}][my_a]" rows="3" required>{{ old("faq.$index.my_a", $item['my_a']) }}</textarea>
                </label>
            </div>
        @endforeach

        <div class="admin-toolbar">
            <button class="admin-btn admin-btn-gold" type="submit">Save settings</button>
        </div>
    </form>
@endsection
