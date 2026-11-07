<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Main Pages --}}
    <url>
        <loc>{{ rtrim(route('home'), '/') . '/' }}</loc>
    </url>

    <url>
        <loc>{{ route('contact') }}</loc>
    </url>

    <url>
        <loc>{{ route('about-us') }}</loc>
    </url>

    <url>
        <loc>{{ route('privacy-policy') }}</loc>
    </url>

    <url>
        <loc>{{ route('terms-and-conditions') }}</loc>
    </url>

    {{-- Blog --}}
    <url>
        <loc>{{ route('blog.index') }}</loc>
    </url>

    @foreach($blogs as $blog)
    <url>
        <loc>{{ route('blog.show', $blog->slug) }}</loc>
    </url>
    @endforeach

    {{-- Tools --}}
    <url>
        <loc>{{ route('image.cropper') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.compressor') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.resizer') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.converter') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.background_remover') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.to.jpg') }}</loc>
    </url>

    <url>
        <loc>{{ route('image.rotator') }}</loc>
    </url>

    <url>
        <loc>{{ route('video.to.audio') }}</loc>
    </url>

    <url>
        <loc>{{ route('pdf.editor') }}</loc>
    </url>

    <url>
        <loc>{{ route('pdf.to.word') }}</loc>
    </url>

    <url>
        <loc>{{ route('word.pdf.index') }}</loc>
    </url>

    <url>
        <loc>{{ route('watermark.remover') }}</loc>
    </url>

    <url>
        <loc>{{ route('metadata.remover') }}</loc>
    </url>

</urlset>
