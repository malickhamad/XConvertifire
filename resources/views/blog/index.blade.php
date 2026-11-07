@extends('components.app')

@section('meta')

<title>FREE File Conversion Guides & Tips | XConvertifire</title>

<meta name="description"
 content="Explore FREE file conversion guides, tips, and tutorials from XConvertifire. Learn to convert, compress, resize, edit, and manage files online with ease.">

<meta property="og:title" content="FREE File Conversion Guides & Tips | XConvertifire">
<meta property="og:description"
    content="Explore FREE file conversion guides, tips, and tutorials from XConvertifire. Learn to convert, compress, resize, edit, and manage files online with ease.">

@endsection

@section('canonical', 'https://xconvertifire.com/blog' . ($blogs->currentPage() > 1 ? '?page=' . $blogs->currentPage() : ''))

@section('content')

<div class="bg-black text-white min-vh-100" style="margin-top: 105px;">

{{-- Header --}}
<div class="container pt-5 pb-4 text-center">

    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">
        <i class="fas fa-book-open me-1"></i> Convertifire Blog
    </span>

    <h1 class="display-5 fw-bold mb-2">
        Tips, Guides & <span class="text-primary">Insights</span>
    </h1>

    <p class="text-secondary mb-0">
        Helpful articles, tutorials and insights from Convertifire.
    </p>

</div>


{{-- Latest Blog --}}
@if($featuredBlog)

    <section class="container pb-5">

        <div class="mb-4">

            <h2 class="h3 fw-bold mb-1">
                Latest Blog
            </h2>

            <p class="text-secondary mb-0">
                Our latest article and useful insights.
            </p>

        </div>


        <article class="card bg-dark border border-secondary border-opacity-25 rounded-4 overflow-hidden shadow-sm">

            <div class="row g-0 align-items-center">

                {{-- Image --}}
                <div class="col-lg-6">

                    <a href="{{ route('blog.show', $featuredBlog->slug) }}">

                        <div class="ratio ratio-16x9">

                            @if($featuredBlog->featured_image)

                                <img
                                    src="{{ asset('storage/' . $featuredBlog->featured_image) }}"
                                    alt="{{ $featuredBlog->title }}"
                                    class="w-100 h-100 object-fit-contain"
                                    loading="lazy">

                            @else

                                <div class="bg-primary bg-gradient d-flex align-items-center justify-content-center text-white">
                                    <i class="fas fa-newspaper fa-4x"></i>
                                </div>

                            @endif

                        </div>

                    </a>

                </div>


                {{-- Content --}}
                <div class="col-lg-6">

                    <div class="p-4 p-lg-5">

                        <div class="small text-secondary mb-3">

                            @if($featuredBlog->category)

                                <span class="text-primary">
                                    {{ $featuredBlog->category }}
                                </span>

                                <span class="mx-1">•</span>

                            @endif

                            @if($featuredBlog->published_at)
                                {{ $featuredBlog->published_at->format('M d, Y') }}
                            @endif

                        </div>


                        <a
                            href="{{ route('blog.show', $featuredBlog->slug) }}"
                            class="text-white text-decoration-none">

                            <h2 class="display-6 fw-bold lh-sm mb-3">
                                {{ $featuredBlog->title }}
                            </h2>

                        </a>


                        <p class="text-secondary lh-lg mb-0">

                            {{ $featuredBlog->excerpt
                                ?: \Illuminate\Support\Str::limit(
                                    strip_tags($featuredBlog->content),
                                    180
                                )
                            }}

                        </p>

                    </div>

                </div>

            </div>

        </article>

    </section>

@endif


{{-- All Other Blogs --}}
@if($blogs->count())

    <section class="container pb-5">

        <div class="mb-4">

            <h2 class="h3 fw-bold mb-1">
                More Articles
            </h2>

            <p class="text-secondary mb-0">
                Explore more useful articles from Convertifire.
            </p>

        </div>


        <div class="row g-4">

            @foreach($blogs as $blog)

                <div class="col-lg-4 col-md-6">

                    <article class="card h-100 bg-dark border border-secondary border-opacity-25 rounded-4 overflow-hidden shadow-sm">

                        {{-- Image --}}
                        <a href="{{ route('blog.show', $blog->slug) }}">

                            <div class="ratio ratio-16x9">

                                @if($blog->featured_image)

                                    <img
                                        src="{{ asset('storage/' . $blog->featured_image) }}"
                                        alt="{{ $blog->title }}"
                                        class="w-100 h-100 object-fit-contain"
                                        loading="lazy">

                                @else

                                    <div class="bg-primary bg-gradient d-flex align-items-center justify-content-center text-white">
                                        <i class="fas fa-newspaper fa-3x"></i>
                                    </div>

                                @endif

                            </div>

                        </a>


                        <div class="card-body p-4">

                            <div class="small text-secondary mb-2">

                                @if($blog->category)

                                    <span class="text-primary">
                                        {{ $blog->category }}
                                    </span>

                                    <span class="mx-1">•</span>

                                @endif

                                @if($blog->published_at)
                                    {{ $blog->published_at->format('M d, Y') }}
                                @endif

                            </div>


                            <a
                                href="{{ route('blog.show', $blog->slug) }}"
                                class="text-white text-decoration-none">

                                <h3 class="h5 fw-bold lh-sm mb-2">
                                    {{ $blog->title }}
                                </h3>

                            </a>


                            <p class="small text-secondary lh-lg mb-0">

                                {{ $blog->excerpt
                                    ?: \Illuminate\Support\Str::limit(
                                        strip_tags($blog->content),
                                        110
                                    )
                                }}

                            </p>

                        </div>

                    </article>

                </div>

            @endforeach

        </div>


        {{-- Pagination --}}
        @if($blogs->hasPages())

            <div class="d-flex justify-content-center mt-5">
                {{ $blogs->links() }}
            </div>

        @endif

    </section>

@endif


{{-- No Blogs --}}
@if(!$featuredBlog && !$blogs->count())

    <div class="container pb-5">

        <div class="text-center py-5">

            <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>

            <h3 class="fw-bold">
                No Articles Yet
            </h3>

            <p class="text-secondary">
                New articles will be published here soon.
            </p>

        </div>

    </div>

@endif

</div>

@endsection
