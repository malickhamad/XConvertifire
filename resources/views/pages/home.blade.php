@extends('components.app')

@section('canonical', 'https://xconvertifire.com/')

@section('meta')
    <title>FREE Online File Converter: Convert Files | XConvertifire</title>
    <meta name="description"
        content="Use XConvertifire's FREE online tools to convert, compress, resize, crop, rotate, edit PDFs, remove backgrounds, and process files quickly and securely." />

    <meta property="og:title" content="FREE Online File Converter: Convert Files | XConvertifire">
    <meta property="og:description"
        content="Use XConvertifire's FREE online tools to convert, compress, resize, crop, rotate, edit PDFs, remove backgrounds, and process files quickly and securely.">

    <meta property="twitter:title" content="FREE Online File Converter: Convert Files | XConvertifire">
    <meta property="twitter:description"
        content="Use XConvertifire's FREE online tools to convert, compress, resize, crop, rotate, edit PDFs, remove backgrounds, and process files quickly and securely.">

    @php
        $homeSchemaUrl = 'https://xconvertifire.com/';
        $organizationSchemaId = $homeSchemaUrl . '#organization';
        $homeSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => $homeSchemaUrl . '#website',
                    'name' => 'XConvertifire',
                    'url' => $homeSchemaUrl,
                    'publisher' => [
                        '@id' => $organizationSchemaId,
                    ],
                ],
                [
                    '@type' => 'Organization',
                    '@id' => $organizationSchemaId,
                    'name' => 'XConvertifire',
                    'url' => $homeSchemaUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => $homeSchemaUrl . 'assets/images/logo.png',
                    ],
                    'sameAs' => [
                        'https://www.linkedin.com/company/x-convertifire/',
                        'https://www.instagram.com/xconvertifire',
                        'https://x.com/xconvertifire',
                    ],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($homeSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) !!}</script>
@endsection

@section('content')
    <main id="main-content">
    <!-- Hero Section -->
    <section class="hero-section">

        <!-- Background Video -->
        <video class="hero-bg-video" loop muted playsinline preload="none" aria-hidden="true" tabindex="-1">
            <source data-src="{{ asset('assets/video/Convertifire.mp4') }}" type="video/mp4">
        </video>

        <!-- Dark Overlay over Video -->
        <div class="hero-overlay"></div>

        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-8"> <!-- Column to keep content on the left side -->

                    <div>
                        <span class="tag-badge"><i class="fas fa-magic text-light me-2"></i> Free Online Toolkit</span>
                    </div>

                    <h1 class="hero-title">
                        Free Online File Tools for Images, PDFs and Video
                    </h1>

                    <p class="hero-subtitle">
                        Compress, resize, crop and convert images,
                        edit PDF documents, and extract audio
                        from videos with XConvertifire's free tools.
                    </p>

                    <!-- Tool Category Navigation -->
                    <div class="filter-pills">
                        <button type="button" class="pill active" data-target="tools">All</button>
                        <button type="button" class="pill" data-target="images">Images</button>
                        <button type="button" class="pill" data-target="videos">Videos</button>
                        <button type="button" class="pill" data-target="pdfs">PDFs</button>
                        {{-- <button class="pill">Archives</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Tools Grid Section (Exact 12 Cards) -->
    <section id="tools" class="container tools-grid mt-5">
        <h2 class="fw-bold mb-4">Explore Our Free Online Tools</h2>

        <div class="row g-4">

            <!-- Tool 1 -->
            <div id="images" class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="50">
                <a href="{{ route('image.compressor') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card  anim-border">
                        <div class="icon-box bg-green"><i class="fas fa-compress-arrows-alt"></i></div>
                        <h3>Compress IMAGE</h3>
                        <p>Compress JPG, PNG, SVG, GIF, and WebP images with adjustable quality settings to reduce file
                            size.</p>
                    </div>
                </a>
            </div>
            <!-- Tool 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('image.resizer') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <div class="icon-box bg-blue"><i class="fas fa-expand-arrows-alt"></i></div>
                        <h3>Resize IMAGE</h3>
                        <p>Resize JPG, PNG, SVG, GIF, and WebP images by setting custom dimensions and adjusting the aspect
                            ratio.</p>
                    </div>
                </a>
            </div>

            <!-- Tool 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <a href="{{ route('image.cropper') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <div class="icon-box bg-cyan"><i class="fas fa-crop-alt"></i></div>
                        <h3>Crop IMAGE</h3>
                        <p>Crop JPG, PNG, WebP, and GIF images with a visual editor, preset aspect ratios, or custom
                            dimensions.</p>
                    </div>
                </a>

            </div>

            <!-- Tool 4 -->

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <a href="{{ route('image.rotator') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <div class="icon-box bg-cyan">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3>Rotate IMAGE</h3>
                        <p>Rotate JPG, PNG, WebP, and GIF images by 90°, 180°, or 270°, then download the result.</p>
                    </div>
                </a>
            </div>



            <!-- Tool 5 -->

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('image.converter') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <div class="icon-box bg-yellow"><i class="fas fa-file-export"></i></div>
                        <h3>Image Converter</h3>
                        <p>Convert multiple images to JPEG, JPG, PNG, WebP, GIF, or PDF by choosing the output format.</p>
                    </div>
                </a>

            </div>


            <!-- Tool 6 -->

            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('image.background_remover') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">

                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>
                        <div class="icon-box bg-red"><i class="fas fa-eraser"></i></div>
                        <h3>Remove background</h3>
                        <p>Remove backgrounds from JPG, PNG, WebP, and GIF images, refine the cutout, and download it as a
                            PNG.</p>
                    </div>
                </a>

            </div>

            <!-- Tool 7 -->


            <div id="videos" class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('video.to.audio') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <div class="icon-box bg-purple"><i class="fas fa-music"></i></div>
                        <h3>Video to Audio</h3>
                        <p>Extract audio from MP4, MOV, AVI, WebM, MKV, MPEG, MPG, FLV, and 3GP videos as MP3, WAV, or M4A.
                        </p>
                    </div>
                </a>
            </div>


            <!-- Tool 8 -->

            <div id="pdfs" class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <a href="{{ route('pdf.editor') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>

                        <div class="icon-box bg-green">
                            <i class="fas fa-file-pdf"></i>
                        </div>

                        <h3>PDF Editor</h3>

                        <p>
                            Edit text in a PDF, undo your changes, and download the updated document.
                        </p>
                    </div>
                </a>
            </div>




            <!-- Tool 9 -->
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <a href="{{ route('pdf.to.word') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>

                        <div class="icon-box bg-green">
                            <i class="fas fa-file-word"></i>
                        </div>

                        <h3>PDF to Word</h3>

                        <p>
                            Convert one or more PDF files into editable Word documents.
                        </p>
                    </div>
                </a>
            </div>

            <!-- Tool 10 -->
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <a href="{{ route('word.pdf.index') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>

                        <div class="icon-box bg-red">
                            <i class="fas fa-file-pdf"></i>
                        </div>

                        <h3>Word to PDF</h3>

                        <p>
                            Convert one or more DOC or DOCX files into PDF documents.
                        </p>
                    </div>
                </a>
            </div>
            <!-- Tool 11 -->
            <!-- Watermark Remover -->
            <!-- Watermark Remover -->
            <div id="watermark-remover" class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="550">
                <a href="{{ route('watermark.remover') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>

                        <div class="icon-box bg-cyan">
                            <i class="fas fa-eraser"></i>
                        </div>

                        <h3>Watermark Remover</h3>

                        <p>
                            Remove or clean unwanted watermark areas from images online. Supports JPG, PNG, and WebP.
                        </p>
                    </div>
                </a>
            </div>

            <!-- Tool 12 -->


            <div id="metadata-remover" class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('metadata.remover') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    <div class="tool-card anim-border">
                        <span class="badge-new">New!</span>

                        <div class="icon-box bg-cyan">
                            <i class="fas fa-user-shield"></i>
                        </div>

                        <h3>Metadata Remover</h3>

                        <p>
                            Strip EXIF, GPS, author, and hidden metadata from images and PDFs. Keeps your files clean and
                            private.
                        </p>
                    </div>
                </a>
            </div>




        </div>
    </section>

    <!-- SEO: Helpful Tool Guide -->
    <section class="container py-5" aria-labelledby="tool-guide-title">

        <h2 id="tool-guide-title" class="fw-bold mb-3">
            Find the Right Free Online Tool
        </h2>

        <p class="mb-4">
            XConvertifire provides free online tools
            for images, PDFs, documents, and videos.
            Not sure which tool to choose? Here's
            how to find the right one for your task.
        </p>

        <div class="row g-4">

            <!-- Image Tools -->
            <div class="col-md-4">
                <div class="grid-box h-100">
                    <h3 class="fs-4 fw-semibold mb-3">
                        Compress, Resize or Convert?
                    </h3>

                    <p class="mb-0">
                        Compression reduces image file size,
                        resizing changes its dimensions,
                        and conversion changes its format.
                        Want a smaller image file?
                        Try our
                        <a href="{{ route('image.compressor') }}" class="text-info text-decoration-underline">
                            free image compressor</a>.
                    </p>
                </div>
            </div>

            <!-- PDF Tools -->
            <div class="col-md-4">
                <div class="grid-box h-100">
                    <h3 class="fs-4 fw-semibold mb-3">
                        Work with PDF Documents
                    </h3>

                    <p class="mb-0">
                        PDF files are useful for sharing
                        documents, while Word files are
                        better suited to editing.
                        Need an editable document?
                        Try our
                        <a href="{{ route('pdf.to.word') }}" class="text-info text-decoration-underline">
                            free PDF to Word converter</a>.
                    </p>
                </div>
            </div>

            <!-- Video Tools -->
            <div class="col-md-4">
                <div class="grid-box h-100">
                    <h3 class="fs-4 fw-semibold mb-3">
                        Get Audio from Videos
                    </h3>

                    <p class="mb-0">
                        Sometimes you only need the sound
                        from a video, such as a recording
                        or presentation.
                        Use our
                        <a href="{{ route('video.to.audio') }}" class="text-info text-decoration-underline">
                            free video to audio converter</a>
                        to extract the audio track.
                    </p>
                </div>
            </div>

        </div>
    </section>
    <!-- End Helpful Tool Guide -->

    <!-- Advanced Bento Grid Section -->
    <section class="container py-5 mt-5 mb-5">
        <div class="row g-4">
            <!-- Left Large Box with Embedded Video -->
            <div class="col-lg-6" data-aos="fade-up">
                <div class="grid-box h-100 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-dark border border-secondary mb-3">All-in-One Online Tools</span>
                        <h2>Everything You Need to Work with Files</h2>
                        <p>Compress, resize, crop, rotate and convert images, edit PDF files, convert PDF and Word
                            documents, remove image backgrounds, or extract audio from videos, all from one simple online
                            platform.</p>
                    </div>
                    <!-- 3rd Video Placement inside Bento Box -->
                    <video class="bento-video" loop muted playsinline preload="none" aria-hidden="true" tabindex="-1">
                        <source data-src="{{ asset('assets/video/Convertifire.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <!-- Right Small Boxes -->
            <div class="col-lg-6">
                <div class="row g-4 h-100">
                    <div class="col-12 h-50" data-aos="fade-up" data-aos-delay="100">
                        <div class="grid-box h-100 d-flex flex-column justify-content-center"
                            style="background: url('https://www.transparenttextures.com/patterns/cubes.png'), var(--card-bg);">
                            <i class="fas fa-cloud-upload-alt fa-3x text-light mb-3"></i>
                            <h3>Fast Processing</h3>
                            <p>Get your files processed quickly with easy-to-use tools designed for everyday image, video,
                                and PDF tasks. No complicated software or technical knowledge required.</p>
                        </div>
                    </div>
                    <div class="col-12 h-50" data-aos="fade-up" data-aos-delay="200">
                        <div class="grid-box h-100 d-flex flex-column justify-content-center">
                            <i class="fas fa-mobile-alt fa-3x text-light mb-3"></i>
                            <h3>Works on Any Device</h3>
                            <p>Use Convertifire directly from your browser on mobile, tablet, or desktop. No software
                                installation required. Just upload your file and get started.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Marquee -->
    <section class="py-5 text-center mt-3 border-top border-dark">
        <div data-aos="fade-up">
            <span class="tag-badge">Work Smarter</span>
            <h2 class="fw-bold mt-2 mb-5">Transform, optimize and manage <br>your files in just a few clicks.</h2>
        </div>

        <div class="marquee-container" data-aos="fade-up" data-aos-delay="100">
            <div class="marquee-content">
                <img src="{{ asset('assets/images/brands/aws.svg') }}" alt="AWS" width="75" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/azure.svg') }}" alt="Azure" width="156" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/google-cloud.svg') }}" alt="Google Cloud" width="291" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/apple.svg') }}" alt="Apple" width="37" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/aws.svg') }}" alt="AWS" width="75" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/azure.svg') }}" alt="Azure" width="156" height="45" loading="lazy" decoding="async">
                <img src="{{ asset('assets/images/brands/google-cloud.svg') }}" alt="Google Cloud" width="291" height="45" loading="lazy" decoding="async">
            </div>
        </div>
    </section>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/home.js') }}?v={{ filemtime(public_path('assets/js/home.js')) }}" defer></script>
@endsection
