@props([
    'url' => url()->current(),
    'title' => config('app.name'),
])

@php
    $encodedUrl = urlencode($url);
    $encodedTitle = urlencode($title);
@endphp

<div class="share-buttons">
    <span class="me-2">Share</span>
    <!-- Facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" target="_blank" rel="noopener noreferrer"
        class="btn btn-sm btn-primary" aria-label="Share on Facebook">
        <img src="{{ asset('images/icons/facebook.png') }}" alt="Facebook" />
    </a>

    <!-- X -->
    <a href="https://twitter.com/intent/tweet?text={{ $encodedTitle }}&url={{ $encodedUrl }}" target="_blank"
        rel="noopener noreferrer" class="btn btn-sm btn-info" aria-label="Share on X">
        <img src="{{ asset('images/icons/twitter.png') }}" alt="X" />
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}" target="_blank" rel="noopener noreferrer"
        class="btn btn-sm btn-success" aria-label="Share on WhatsApp">
        <img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp" />
    </a>

    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}" target="_blank"
        rel="noopener noreferrer" class="btn btn-sm btn-secondary" aria-label="Share on LinkedIn">
        <img src="{{ asset('images/icons/linkedin.png') }}" alt="LinkedIn" />
    </a>
</div>
