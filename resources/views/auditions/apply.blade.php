@extends('layouts.app')

@section('title', 'Apply')
@section('description', 'Complete the BCRL audition application form.')

@section('content')
    <header class="page-hero">
        <p class="kicker">05 — Audition form</p>
        <h1>Apply now.</h1>
        <p class="lede">Tell us who you are and why music matters to you. You do not have to be a professional singer to take this step.</p>
        <p lang="my">ဂီတကို ချစ်ပြီး ကိုယ့်အသံကို မျှဝေချင်သူတွေအတွက် BCRL audition လျှောက်လွှာ။</p>
    </header>

    <section class="section">
        <form class="form" method="POST" action="{{ route('auditions.store') }}">
            @csrf
            <div class="honeypot" aria-hidden="true">
                <label for="company_website">Website</label>
                <input id="company_website" type="text" name="company_website" tabindex="-1" autocomplete="off">
            </div>
            <div class="form-grid">
                <label class="field">
                    <span>Full name / <span lang="my">အမည်အပြည့်အစုံ</span></span>
                    <input id="full_name" name="full_name" value="{{ old('full_name') }}" required maxlength="120" autocomplete="name">
                    @error('full_name') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Age / <span lang="my">အသက်</span></span>
                    <input name="age" type="number" inputmode="numeric" min="8" max="99" value="{{ old('age') }}">
                    @error('age') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>City / <span lang="my">မြို့</span></span>
                    <input name="city" value="{{ old('city') }}" required maxlength="120" autocomplete="address-level2">
                    @error('city') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Phone or Telegram / <span lang="my">ဖုန်း သို့မဟုတ် Telegram</span></span>
                    <input name="contact" value="{{ old('contact') }}" required maxlength="160" autocomplete="tel">
                    @error('contact') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field wide">
                    <span>Email <span class="note">(optional)</span></span>
                    <input name="email" type="email" value="{{ old('email') }}" maxlength="160" autocomplete="email">
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>I want to / <span lang="my">စိတ်ဝင်စားမှု</span></span>
                    <select name="interest" required>
                        <option value="" @selected(old('interest') === null) disabled>Choose one</option>
                        @foreach (config('bcrl.interests') as $value => $label)
                            <option value="{{ $value }}" @selected(old('interest') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('interest') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field">
                    <span>Experience / <span lang="my">အတွေ့အကြုံ</span></span>
                    <select name="experience" required>
                        <option value="" @selected(old('experience') === null) disabled>Choose one</option>
                        @foreach (config('bcrl.experiences') as $value => $label)
                            <option value="{{ $value }}" @selected(old('experience') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('experience') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field wide">
                    <span>Why BCRL? / <span lang="my">ဘာကြောင့် BCRL မှာ ပါဝင်ချင်သလဲ</span></span>
                    <textarea name="why" required minlength="20" maxlength="2000">{{ old('why') }}</textarea>
                    @error('why') <p class="field-error">{{ $message }}</p> @enderror
                </label>
                <label class="field wide">
                    <span>Demo link / <span lang="my">နမူနာလင့်</span> <span class="note">(optional — YouTube, Telegram, or Drive)</span></span>
                    <input name="demo_url" type="url" value="{{ old('demo_url') }}" maxlength="500" placeholder="https://">
                    @error('demo_url') <p class="field-error">{{ $message }}</p> @enderror
                </label>
            </div>
            <label class="check">
                <input type="checkbox" name="consent" value="1" @checked(old('consent')) required>
                <span>I agree to be contacted by BCRL about this application. See the <a href="{{ route('legal.privacy') }}">privacy policy</a>.</span>
            </label>
            @error('consent') <p class="field-error">{{ $message }}</p> @enderror
            <button class="btn btn-ink" type="submit">Submit application</button>
        </form>
    </section>
@endsection
