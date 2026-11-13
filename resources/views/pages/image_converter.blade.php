@extends('components.app')

@section('canonical', 'https://xconvertifire.com/image-converter')

@section('meta')
    <title>FREE Image Converter: Convert Images Online | XConvertifire</title>

    <meta name="description" content="Convert JPG, PNG and WebP images online for free. Convert multiple photos to JPG, PNG, WebP or PDF, then download files or a ZIP with XConvertifire." />

    <meta property="og:type" content="website">
    <meta property="og:title" content="FREE Image Converter: Convert Images Online | XConvertifire">
    <meta property="og:description" content="Convert JPG, PNG and WebP images online for free. Convert multiple photos to JPG, PNG, WebP or PDF, then download files or a ZIP with XConvertifire.">
    <meta property="og:url" content="{{ route('image.converter') }}">
    <meta property="og:site_name" content="XConvertifire">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="XConvertifire logo">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="FREE Image Converter: Convert Images Online | XConvertifire">
    <meta name="twitter:description" content="Convert JPG, PNG and WebP images online for free. Convert multiple photos to JPG, PNG, WebP or PDF, then download files or a ZIP with XConvertifire.">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/image-converter.css') }}">

    <style>
        /* ---------- SEO cards (unchanged) ---------- */
        .seo-card {
            background: #151515 !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            border-radius: 1rem !important;
        }
        .seo-card .accordion-button {
            background: #151515 !important;
            color: #fff !important;
            box-shadow: none !important;
            font-weight: 600;
        }
        .seo-card .accordion-button:not(.collapsed) {
            background: rgba(59, 130, 246, 0.08) !important;
            color: #60a5fa !important;
        }
        .seo-card .accordion-button::after { filter: invert(1); }
        .seo-card .accordion-body {
            background: #151515 !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .converter-format-note {
            margin-top: 16px;
            padding: 12px 14px;
            border-left: 3px solid rgba(96, 165, 250, 0.7);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.035);
            color: rgba(255, 255, 255, 0.76);
            font-size: 0.8rem;
            line-height: 1.6;
        }

        /* =========================================================
           CONVERTER EDITOR  (same look as Image Resizer editor)
           Scoped under .cv-editor so it overrides image-converter.css
        ========================================================== */
        .cv-editor {
            width: 100%;
            padding: 0;
            margin: 0;
            background: transparent;
            border: 0;
            box-shadow: none;
            cursor: default;
            text-align: left;
        }

        .cv-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .cv-title {
            margin: 0;
            color: #fff;
            font-weight: 700;
            font-size: clamp(1.5rem, 2.4vw, 2rem);
            letter-spacing: -0.02em;
        }

        .cv-title span {
            color: rgba(255, 255, 255, 0.7);
        }

        .cv-head-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cv-editor .cv-add,
        .cv-editor .cv-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 600;
            line-height: 1.4;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease;
        }

        .cv-editor .cv-add {
            border: 1px solid rgba(96, 165, 250, 0.4);
            background: rgba(59, 130, 246, 0.12);
            color: #60a5fa;
        }

        .cv-editor .cv-add:hover {
            background: rgba(59, 130, 246, 0.22);
        }

        .cv-editor .cv-cancel {
            border: 0;
            background: #f87171;
            color: #fff;
        }

        .cv-editor .cv-cancel:hover {
            background: #ef4444;
        }

        .cv-editor .cv-add:focus-visible,
        .cv-editor .cv-cancel:focus-visible,
        .cv-editor .format-btn:focus-visible,
        .cv-editor .converter-convert-btn:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 2px;
        }

        /* ---------- Left: files preview ---------- */
        .cv-preview {
            height: 100%;
            min-height: 480px;
            max-height: 640px;
            padding: 20px;
            overflow-y: auto;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background-color: #0b0b0c;
            background-image:
                linear-gradient(45deg, #141414 25%, transparent 25%),
                linear-gradient(-45deg, #141414 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #141414 75%),
                linear-gradient(-45deg, transparent 75%, #141414 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0;
        }

        .cv-editor .converter-file-grid {
            display: grid !important;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
            gap: 14px !important;
            margin: 0 !important;
            padding: 0 !important;
            background: transparent !important;
            border: 0 !important;
        }

        .cv-editor .converter-file-card {
            position: relative;
            padding: 10px !important;
            border-radius: 16px !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            background: rgba(16, 16, 17, 0.92) !important;
            overflow: hidden;
        }

        .cv-editor .converter-thumb {
            position: relative;
            width: 100% !important;
            height: auto !important;
            aspect-ratio: 1 / 1;
            border-radius: 12px !important;
            overflow: hidden;
            background: #0b0b0c !important;
        }

        .cv-editor .converter-thumb img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            display: block;
        }

        .cv-editor .remove-file {
            position: absolute !important;
            top: 6px !important;
            right: 6px !important;
            width: 26px !important;
            height: 26px !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 0 !important;
            border: 0 !important;
            border-radius: 50% !important;
            background: #f87171 !important;
            color: #fff !important;
            font-size: 0.7rem;
            cursor: pointer;
        }

        .cv-editor .remove-file:hover {
            background: #ef4444 !important;
        }

        .cv-editor .converter-file-name {
            margin-top: 10px;
            color: #fff !important;
            font-size: 0.78rem !important;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cv-editor .converter-file-meta {
            margin-top: 2px;
            color: rgba(255, 255, 255, 0.5) !important;
            font-size: 0.7rem !important;
        }

        /* ---------- Right: panel ---------- */
        .cv-panel {
            padding: 22px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: #101011;
        }

        .cv-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 16px;
            margin-bottom: 10px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: #161617;
        }

        .cv-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .cv-value {
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            text-align: right;
        }

        .cv-section-label {
            display: block;
            margin: 22px 0 10px;
        }

        .cv-editor .format-buttons {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .cv-editor .format-btn {
            display: flex !important;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            gap: 2px;
            width: 100% !important;
            min-height: 62px;
            padding: 10px 12px !important;
            border-radius: 12px !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            background: #161617 !important;
            color: #fff !important;
            text-align: left;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease;
        }

        .cv-editor .format-btn strong {
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .cv-editor .format-btn span {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.68rem;
            line-height: 1.3;
        }

        .cv-editor .format-btn:hover {
            background: #1d1d1f !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .cv-editor .format-btn.active {
            background: rgba(59, 130, 246, 0.14) !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .cv-editor .format-btn.active strong {
            color: #60a5fa;
        }

        .cv-editor .converter-convert-btn {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            width: 100% !important;
            height: 50px;
            margin-top: 18px !important;
            padding: 0 20px !important;
            border: 0 !important;
            border-radius: 14px !important;
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            color: #fff !important;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.3);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .cv-editor .converter-convert-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.4);
        }

        .cv-editor .converter-convert-btn i {
            margin-right: 6px;
        }

        .cv-editor .converter-convert-btn > i {
            margin-right: 0;
        }

        @media (max-width: 991px) {
            .cv-preview {
                min-height: 320px;
                max-height: 480px;
            }
        }

        @media (max-width: 575px) {
            .cv-preview {
                padding: 14px;
                border-radius: 18px;
            }

            .cv-panel {
                padding: 16px;
                border-radius: 18px;
            }

            .cv-head-actions,
            .cv-editor .cv-add,
            .cv-editor .cv-cancel {
                width: 100%;
                justify-content: center;
            }

            .cv-editor .converter-file-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)) !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .cv-editor * {
                transition: none !important;
            }
        }
    </style>
@endsection

@section('content')
    <main class="converter-page bg-black">
        <section class="converter-hero bg-black">

            <section class="mb-5">
                <div class="container">
                    <div class="crop-breadcrumb">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                        <i class="fas fa-chevron-right mx-2"></i>
                        <span>Image Converter</span>
                    </div>
                </div>
            </section>


            <div class="container">

                <div class="converter-heading" id="converterHeading" data-aos="fade-up">

                    <span class="converter-badge">
                        <i class="fas fa-shuffle"></i> IMAGE CONVERTER
                    </span>

                    <h1>
                        Convert Images <span>Online</span>
                    </h1>

                    <p>
                        Convert supported images to JPG, JPEG, PNG, WebP or PDF, one at a time or in a
                        batch. Available output formats depend on browser support.
                    </p>

                </div>

                <div class="cursor-pointer" data-aos="fade-up" data-aos-delay="100">

                    <input type="file" id="converterFileInput" accept="image/*" multiple hidden>

                    {{-- ================= UPLOAD BOX (unchanged) ================= --}}
                    <div class="crop-upload-box converter-upload" id="converterUpload"
                        onclick="document.getElementById('converterFileInput').click()">

                        <div class="converter-upload-icon">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>

                        <h3>
                            Drop your images here
                        </h3>

                        <p>
                            or select multiple images from your device
                        </p>

                        <button type="button" class="converter-primary-btn" id="browseImagesBtn">

                            <i class="fas fa-folder-open"></i>
                            Choose Images

                        </button>

                        <small>
                            JPG, JPEG, PNG, WEBP, GIF • Multiple files supported
                        </small>

                    </div>

                    {{-- ================= EDITOR (resizer-style) ================= --}}
                    <div class="cv-editor d-none" id="converterFilesPanel">

                        <div class="cv-head">
                            <h2 class="cv-title">Convert Your <span>Images</span></h2>

                            <div class="cv-head-actions">
                                <button type="button" class="cv-add" id="addMoreBtn">
                                    <i class="fas fa-plus"></i>
                                    Add More
                                </button>

                                <button type="button" class="cv-cancel" id="clearAllBtn">
                                    <i class="fas fa-xmark"></i>
                                    Clear All
                                </button>
                            </div>
                        </div>

                        <div class="row g-4">

                            {{-- LEFT: selected images --}}
                            <div class="col-lg-8">
                                <div class="cv-preview">
                                    <div class="converter-file-grid" id="fileGrid">
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT: settings panel --}}
                            <div class="col-lg-4">
                                <div class="cv-panel">

                                    <div class="cv-info">
                                        <span class="cv-label">Selected</span>
                                        <span class="cv-value"><span id="imageCount">0</span> images</span>
                                    </div>

                                    <div class="cv-info">
                                        <span class="cv-label">Total Size</span>
                                        <span class="cv-value" id="totalSize">0 B</span>
                                    </div>

                                    <span class="cv-label cv-section-label">Output Format</span>

                                    <div class="format-buttons" id="formatButtons">

                                        <button type="button" class="format-btn active" data-format="jpeg">

                                            <strong>JPEG</strong>

                                            <span>
                                                Best compatibility
                                            </span>

                                        </button>

                                        <button type="button" class="format-btn" data-format="jpg">

                                            <strong>JPG</strong>

                                            <span>
                                                Compact photo
                                            </span>

                                        </button>

                                        <button type="button" class="format-btn" data-format="png">

                                            <strong>PNG</strong>

                                            <span>
                                                Transparent quality
                                            </span>

                                        </button>

                                        <button type="button" class="format-btn" data-format="webp">

                                            <strong>WEBP</strong>

                                            <span>
                                                Modern &amp; lightweight
                                            </span>

                                        </button>

                                        <button type="button" class="format-btn" data-format="gif">

                                            <strong>GIF</strong>

                                            <span>
                                                Web-friendly image
                                            </span>

                                        </button>

                                        <button type="button" class="format-btn" data-format="pdf">

                                            <strong>PDF</strong>

                                            <span>
                                                Document format
                                            </span>

                                        </button>

                                    </div>

                                    <button type="button" class="converter-convert-btn" id="convertBtn">

                                        <span>
                                            <i class="fas fa-wand-magic-sparkles"></i>
                                            Convert Images
                                        </span>

                                        <i class="fas fa-arrow-right"></i>

                                    </button>

                                    <p class="converter-format-note">
                                        JPG and JPEG use the same image encoding. GIF export is not reliably
                                        supported by browser canvas encoding, so an unsupported GIF export may
                                        contain PNG data despite a <code>.gif</code> filename. WebP export
                                        depends on browser support.
                                    </p>
                                    <p class="small text-secondary mt-3">
                                        Need a JPG-first workflow? <a href="{{ route('image.to.jpg') }}">Convert images to JPG online</a> with JPG selected by default.
                                    </p>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="converter-trust-row">

                    <div>
                        <i class="fas fa-shield-halved"></i>
                        <span>Private in your browser</span>
                    </div>

                    <div>
                        <i class="fas fa-layer-group"></i>
                        <span>Batch conversion</span>
                    </div>

                    <div>
                        <i class="fas fa-bolt"></i>
                        <span>Fast processing</span>
                    </div>

                </div>

            </div>

        </section>

        <section class="converter-info-section">

            <div class="container">

                <div class="converter-info-grid">

                    <div class="converter-info-card">

                        <div class="converter-info-icon">
                            <i class="fas fa-images"></i>
                        </div>

                        <h3>
                            Convert in bulk
                        </h3>

                        <p>
                            Select multiple images and process them together.
                        </p>

                    </div>

                    <div class="converter-info-card">

                        <div class="converter-info-icon">
                            <i class="fas fa-sliders"></i>
                        </div>

                        <h3>
                            Multiple output choices
                        </h3>

                        <p>
                            Choose from six output options. JPG and JPEG are extensions of the same
                            image format; GIF and WebP encoding depend on browser support.
                        </p>

                    </div>

                    <div class="converter-info-card">

                        <div class="converter-info-icon">
                            <i class="fas fa-lock"></i>
                        </div>

                        <h3>
                            Browser-Based Processing
                        </h3>
                        <p>
                            Image conversion uses browser-side image and canvas processing. This describes the conversion workflow, not all website activity.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- =========================================================
        SEO CONTENT (unchanged)
    ========================================================== --}}
        <section class="py-5">
    <div class="container">

        <!-- ═══ HERO ═══ -->
        <div class="seo-card shadow-lg mb-5">
            <div class="card-body p-4 p-md-5">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">
                    <i class="fas fa-shuffle me-1"></i> Image Conversion Guide
                </span>
                <h2 class="text-white fw-bold mb-3">Free Online Image Converter</h2>
                <p class="text-secondary mb-3">An image converter online changes a file's format for use in a website, document or app. XConvertifire's free image converter lets you convert images in your browser to JPG, JPEG, PNG, WebP, GIF or PDF. GIF output depends on browser canvas encoding; when GIF encoding is unsupported, the result may contain PNG data even if its filename ends in <code class="text-white">.gif</code>.</p>
                <p class="text-secondary mb-3">JPG and JPEG refer to the same widely supported image encoding and are often used for photographs. PNG is useful for graphics and images that need transparency. WebP can provide a modern web image format, although browser support affects encoding. PDF output collects selected images into a document. The best choice depends on what you are making and where the file will be used.</p>
                <p class="text-secondary mb-0">Select browser-decodable image files, choose one output option and start conversion. Results depend on the source and browser.</p>
            </div>
        </div>

        <!-- ═══ STEPS ═══ -->
        <div class="text-center mb-4">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">How It Works</span>
            <h2 class="text-white fw-bold mb-2">How to Convert Images Online</h2>
            <p class="text-secondary mb-0">The converter follows a short workflow from choosing files to saving the result.</p>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-images"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-2">1. Select Your Images</h3>
                        <p class="text-secondary small mb-0">Select or drop one or more supported images. Add more files before converting if needed.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-sliders"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-2">2. Choose an Output</h3>
                        <p class="text-secondary small mb-0">Select one format for the selected images: JPEG, JPG, PNG, WebP, GIF or PDF. The six controls include JPG and JPEG options for the same encoding format.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-wand-magic-sparkles"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-2">3. Convert the Files</h3>
                        <p class="text-secondary small mb-0">Start conversion and follow its progress. All selected images use the same output choice.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-download"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-2">4. Download the Result</h3>
                        <p class="text-secondary small mb-0">Download the result when ready. A single non-PDF output is a file; multiple non-PDF outputs are packaged in a ZIP.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ FORMATS ═══ -->
        <div class="text-center mb-4 mt-5">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">Format Guide</span>
            <h2 class="text-white fw-bold mb-0">Convert JPG, PNG, WebP and GIF Images</h2>
        </div>

        <p class="text-secondary text-center mb-4">Input depends on browser decoding, so every file with an image extension is not guaranteed to convert.</p>

        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 text-warning mb-3">
                            <i class="fas fa-file-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Convert JPG and JPEG Images</h3>
                        <p class="text-secondary small mb-0">JPG and JPEG are extensions for the same encoding, widely used for photographs. JPEG encoding can be lossy, changing detail or file size. Repeated conversions can accumulate quality changes, so start from the original when practical.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-info bg-opacity-10 border border-info border-opacity-25 text-info mb-3">
                            <i class="fas fa-file-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Convert PNG Images</h3>
                        <p class="text-secondary small mb-0">PNG suits screenshots, illustrations and graphics with transparent areas. Transparency may be retained when supported by the source and browser. For JPEG output, the canvas background is white because JPEG cannot store transparency.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 text-success mb-3">
                            <i class="fas fa-file-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Convert WebP Images</h3>
                        <p class="text-secondary small mb-0">WebP may suit websites that support it. The browser must support WebP encoding; otherwise canvas may return PNG data. Check the download rather than assuming its format or size reduction.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-danger bg-opacity-10 border border-danger border-opacity-25 text-danger mb-3">
                            <i class="fas fa-film"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Convert GIF Input Images</h3>
                        <p class="text-secondary small mb-0">A browser may decode GIF input as an image frame, so this conversion workflow does not preserve animated GIF playback. Do not rely on the GIF output option to create an animated GIF.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ BATCH ═══ -->
        <div class="seo-card shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="text-white fw-bold h4 mb-3">Convert Multiple Images Online</h2>
                <p class="text-secondary mb-3">Add or remove selected images, or clear the selection. One output format applies to the whole batch; process separate groups if they need different formats.</p>
                <p class="text-secondary mb-3">Multiple non-PDF outputs are packaged into a ZIP. No fixed batch-count or upload-size limit is published; practical capacity depends on the browser, device and files.</p>
                <p class="text-secondary mb-0">A single image downloads as a file. PDF uses its own document-generation workflow.</p>
            </div>
        </div>

        <!-- ═══ PDF ═══ -->
        <div class="seo-card shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="text-white fw-bold h4 mb-3">Convert Images to PDF</h2>
                <p class="text-secondary mb-3">Select image files, choose PDF and convert them into a document containing the selected images. Download the generated PDF when processing finishes.</p>
                <p class="text-secondary mb-0">This creates PDFs from images. It does not accept existing PDF documents and convert their pages to images. Review the result before printing or sharing.</p>
            </div>
        </div>

        <!-- ═══ FORMAT COMPARISON ═══ -->
        <div class="text-center mb-4 mt-5">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">Format Comparison</span>
            <h2 class="text-white fw-bold mb-2">JPG vs PNG vs WebP: Which Format Should You Choose?</h2>
            <p class="text-secondary mb-0">Choose an output based on image content, transparency, intended use and compatibility. Results vary by image and browser.</p>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 text-warning mb-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">JPG for Photographs</h3>
                        <p class="text-secondary small mb-0">JPG/JPEG suits many photographs and is broadly supported, but its lossy encoding cannot retain transparency. Transparent canvas areas are filled white. Inspect details and edges after export.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-info bg-opacity-10 border border-info border-opacity-25 text-info mb-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">PNG for Graphics and Transparency</h3>
                        <p class="text-secondary small mb-0">PNG often suits screenshots, diagrams, text-heavy graphics and transparent artwork. It may retain source transparency where supported, but is not guaranteed to be smaller than JPEG or WebP.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 text-success mb-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">WebP for Modern Web Images</h3>
                        <p class="text-secondary small mb-0">WebP may suit modern web use, but destination compatibility varies and browser support determines whether encoding succeeds. Check format and appearance before publishing.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ QUALITY & TRANSPARENCY ═══ -->
        <div class="seo-card shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                <h2 class="text-white fw-bold h4 mb-3">Image Conversion, Transparency and Quality</h2>
                <p class="text-secondary mb-3">Conversion changes encoding, unlike resizing dimensions or compressing file data. It may alter visual quality and does not guarantee a smaller file or unchanged pixels.</p>
                <ul class="text-secondary mb-3 ps-3">
                    <li class="mb-2">JPEG does not support transparent pixels. This converter uses a white canvas background for JPEG output.</li>
                    <li class="mb-2">PNG can retain transparency when the input and browser-based export support it.</li>
                    <li class="mb-2">WebP output depends on browser encoding support and does not promise a specific reduction percentage.</li>
                    <li class="mb-2">Review the downloaded file, including its format, transparency, dimensions and fine details.</li>
                </ul>
                <p class="text-secondary mb-0">If your next step is to reduce file size, use the <a href="{{ route('image.compressor') }}" class="text-primary">image compressor</a>. For changing pixel dimensions, the <a href="{{ route('image.resizer') }}" class="text-primary">image resizer</a> is more appropriate. To remove unwanted edges, use the <a href="{{ route('image.cropper') }}" class="text-primary">image cropper</a>. If an image needs a different orientation, try the <a href="{{ route('image.rotator') }}" class="text-primary">image rotator</a>.</p>
            </div>
        </div>

        <!-- ═══ WHY CONVERT ═══ -->
        <div class="text-center mb-4 mt-5">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">Common Uses</span>
            <h2 class="text-white fw-bold mb-0">Common Reasons to Convert Images</h2>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Prepare Website Images</h3>
                        <p class="text-secondary small mb-0">If a website requests a particular format, convert a copy and test it there. Requirements vary; no format is accepted everywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-share-nodes"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Share Photos in Compatible Formats</h3>
                        <p class="text-secondary small mb-0">Convert a photo when a recipient expects JPEG or PNG. Choose based on compatibility, transparency and graphic detail.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-file-powerpoint"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Use Graphics in Documents</h3>
                        <p class="text-secondary small mb-0">For documents or presentations, PNG may suit transparent artwork and text-heavy visuals; JPEG may suit photos without transparency.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Create Image-Based PDFs</h3>
                        <p class="text-secondary small mb-0">Use PDF output to combine selected images into a document, then check its pages and image placement.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Convert a Batch for a Project</h3>
                        <p class="text-secondary small mb-0">Convert several assets to one format and download the ZIP. Separate groups that need different formats.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="seo-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3 class="h6 text-white fw-semibold mb-3">Prepare Files for Online Uploads</h3>
                        <p class="text-secondary small mb-0">Forms and marketplaces may specify formats. Convert a copy and check the platform's file, dimension and size rules.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══ TIPS ═══ -->
        <div class="seo-card shadow-sm mb-5">
            <div class="card-body p-4 p-md-5">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 mb-3">Best Practices</span>
                <h2 class="text-white fw-bold h4 mb-4">Tips for Better Image Conversion Results</h2>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Choose for the image.</strong> Consider detail, transparency and destination compatibility.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Check transparency before choosing JPEG.</strong> The converter places transparent canvas areas on white for JPEG output.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Review fine details.</strong> Re-encoding may affect small text and sharp lines.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Check dimensions and file size.</strong> Conversion is not a resizing operation and does not promise a smaller file.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Account for browser support.</strong> WebP and GIF encoding may not yield the requested format.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Avoid repeated lossy conversions.</strong> Keep the original for making other versions.</p>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                        <p class="text-secondary small mb-0"><strong class="text-white">Test before publishing.</strong> Open the output and check it in the destination workflow.</p>
                    </div>
                </div>
                <p class="text-secondary small mt-4 mb-0">For technical detail, see MDN's guides to <a href="https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types" target="_blank" rel="noopener noreferrer" class="text-primary">web image formats</a> and <a href="https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/toBlob" target="_blank" rel="noopener noreferrer" class="text-primary">canvas image encoding</a>.</p>
            </div>
        </div>

        <!-- ═══ FAQ ═══ -->
        <div class="text-center mb-4 mt-5">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">FAQ</span>
            <h2 class="text-white fw-bold mb-0">Frequently Asked Questions About Image Conversion</h2>
        </div>

        <div class="accordion mb-5" id="converterFaqAccordion">

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqOne">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Is XConvertifire's Image Converter free?
                    </button>
                </h3>
                <div id="cvfaqOne" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Yes. The Image Converter is available online for converting supported image files to one of the provided output options.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqTwo">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Which image formats can I upload?
                    </button>
                </h3>
                <div id="cvfaqTwo" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        The file input accepts image files, and conversion requires the browser to decode them. JPG, JPEG, PNG, WebP and GIF are common supported image types; not every image format is guaranteed to work in every browser.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqThree">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert JPG to PNG?
                    </button>
                </h3>
                <div id="cvfaqThree" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Yes. Select a JPG/JPEG image and choose PNG. Check the result because encoding and appearance depend on the source and browser.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqFour">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert PNG to JPG?
                    </button>
                </h3>
                <div id="cvfaqFour" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Yes. Choose JPG or JPEG output. The converter fills the JPEG canvas background with white because JPEG cannot keep transparency.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqFive">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert images to WebP?
                    </button>
                </h3>
                <div id="cvfaqFive" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        You can select WebP output. Successful WebP encoding depends on the browser, so verify the resulting file format.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqSix">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert multiple images at once?
                    </button>
                </h3>
                <div id="cvfaqSix" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Yes. Select or add multiple images and apply one output format to the selection. Different formats must be handled in separate conversions.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqSeven">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        How do I download multiple converted images?
                    </button>
                </h3>
                <div id="cvfaqSeven" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        For multiple non-PDF images, the converter packages the results into one ZIP archive. PDF output creates a PDF document containing the selected images.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqEight">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert images into a PDF?
                    </button>
                </h3>
                <div id="cvfaqEight" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Yes. Select image files, choose PDF and convert them into a generated image-based PDF document.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqNine">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert a PDF into an image?
                    </button>
                </h3>
                <div id="cvfaqNine" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        No. This converter creates PDFs from images; it does not accept PDF files and convert their pages into images.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqTen">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Will converting an image reduce its file size?
                    </button>
                </h3>
                <div id="cvfaqTen" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        Not necessarily. Output size depends on the source, selected format and browser encoding. A smaller file or specific reduction is not guaranteed.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqEleven">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Does JPG support transparent backgrounds?
                    </button>
                </h3>
                <div id="cvfaqEleven" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        No. JPEG does not support transparency. The converter uses a white background for JPEG output.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqTwelve">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Can I convert animated GIFs without losing animation?
                    </button>
                </h3>
                <div id="cvfaqTwelve" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        No. The browser canvas workflow does not preserve animated GIF frames; GIF input may be decoded as a static image.
                    </div>
                </div>
            </div>

            <div class="seo-card mb-2 overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqThirteen">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Does the GIF output option work in every browser?
                    </button>
                </h3>
                <div id="cvfaqThirteen" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        No. Canvas GIF encoding is not reliably supported. An unsupported request may produce PNG data even if the output filename ends in <code class="text-white">.gif</code>.
                    </div>
                </div>
            </div>

            <div class="seo-card overflow-hidden">
                <h3 class="accordion-header m-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cvfaqFourteen">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Are selected images processed in the browser?
                    </button>
                </h3>
                <div id="cvfaqFourteen" class="accordion-collapse collapse" data-bs-parent="#converterFaqAccordion">
                    <div class="accordion-body small">
                        The converter's image decoding and conversion use browser-side image and canvas processing. This describes the conversion workflow, not a blanket statement about all website activity.
                    </div>
                </div>
            </div>

        </div>

        <!-- ═══ FINAL CTA ═══ -->
        <div class="seo-card shadow-lg">
            <div class="card-body p-4 p-md-5 text-center">
                <h2 class="text-white fw-bold mb-3">Convert Your Images Online for Free</h2>
                <p class="text-secondary mb-4">Upload your images, choose a supported output format and download the converted result using XConvertifire's free online Image Converter.</p>
                <a href="#converterUpload" id="converterSeoCta" class="btn btn-primary btn-lg fw-semibold px-4 py-2">
                    <i class="fas fa-shuffle me-2"></i>Convert Your Images Now
                </a>
            </div>
        </div>

    </div>
</section>

    </main>

    <div class="conversion-overlay" id="conversionOverlay">

        <div class="conversion-modal position-relative">
            <button type="button" id="closeConversionBtn"
                class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-3 d-none" title="Close">
                <i class="fas fa-xmark"></i>
            </button>

            {{-- Loader --}}
            <div class="conversion-spinner" id="conversionSpinner">

                <span></span>

                <i class="fas fa-shuffle"></i>

            </div>

            {{-- Status --}}
            <span class="conversion-status-label" id="conversionStatusLabel">

                PROCESSING

            </span>

            <h2 id="conversionTitle">
                Converting your images
            </h2>

            <p id="conversionStatus">
                Preparing your files...
            </p>

            <div class="conversion-progress" id="conversionProgress">

                <span id="conversionProgressBar"></span>

            </div>

            <div class="conversion-progress-text" id="conversionProgressTextWrapper">

                <span id="conversionProgressText">
                    0%
                </span>

                <span>
                    Please wait
                </span>

            </div>

            {{-- Download Button --}}
            <button type="button" id="downloadConvertedBtn" class="converter-primary-btn d-none mt-3">

                <i class="fas fa-download"></i>
                Download

            </button>

        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    {{-- JSZip --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic'
        });


        const input = document.getElementById('converterFileInput'),
            upload = document.getElementById('converterUpload'),
            panel = document.getElementById('converterFilesPanel'),
            grid = document.getElementById('fileGrid'),
            count = document.getElementById('imageCount'),
            totalSizeEl = document.getElementById('totalSize'),
            heroHeading = document.getElementById('converterHeading');


        let files = [],
            format = 'jpeg';


        /*
         * Converted file waiting for download
         */
        let convertedBlob = null,
            convertedFileName = '',
            convertedUrl = null;


        const overlay =
            document.getElementById('conversionOverlay');

        const spinner =
            document.getElementById('conversionSpinner');

        const statusLabel =
            document.getElementById('conversionStatusLabel');

        const conversionTitle =
            document.getElementById('conversionTitle');

        const bar =
            document.getElementById('conversionProgressBar');

        const pct =
            document.getElementById('conversionProgressText');

        const stat =
            document.getElementById('conversionStatus');

        const progress =
            document.getElementById('conversionProgress');

        const progressTextWrapper =
            document.getElementById('conversionProgressTextWrapper');

        const downloadBtn =
            document.getElementById('downloadConvertedBtn');


        const add = (list) => {

            files.push(
                ...list.filter(f => f.type.startsWith('image/'))
            );

            render();

            input.value = '';

        };


        document.getElementById('browseImagesBtn').onclick = () =>
            input.click();


        document.getElementById('addMoreBtn').onclick = () =>
            input.click();


        input.onchange = e =>
            add([...e.target.files]);


        ['dragenter', 'dragover'].forEach(x =>
            upload.addEventListener(x, e => {

                e.preventDefault();

                upload.classList.add('dragging');

            })
        );


        ['dragleave', 'drop'].forEach(x =>
            upload.addEventListener(x, e => {

                e.preventDefault();

                upload.classList.remove('dragging');

            })
        );


        upload.addEventListener('drop', e =>
            add([...e.dataTransfer.files])
        );


        function render() {

            grid.innerHTML = '';

            count.textContent = files.length;

            totalSizeEl.textContent =
                bytes(files.reduce((sum, f) => sum + f.size, 0));


            if (!files.length) {

                panel.classList.add('d-none');

                upload.classList.remove('d-none');

                if (heroHeading) {
                    heroHeading.classList.remove('d-none');
                }

                return;

            }


            upload.classList.add('d-none');

            panel.classList.remove('d-none');

            if (heroHeading) {
                heroHeading.classList.add('d-none');
            }


            files.forEach((f, i) => {

                const u = URL.createObjectURL(f),
                    c = document.createElement('div');


                c.className =
                    'converter-file-card';


                c.innerHTML = `

                    <div class="converter-thumb">

                        <img src="${u}" alt="">

                        <button type="button" class="remove-file">

                            <i class="fas fa-xmark"></i>

                        </button>

                    </div>

                    <div class="converter-file-name"
                        title="${esc(f.name)}">

                        ${esc(f.name)}

                    </div>

                    <div class="converter-file-meta">

                        ${bytes(f.size)}

                    </div>

                `;


                c.querySelector('button').onclick = () => {

                    files.splice(i, 1);

                    URL.revokeObjectURL(u);

                    render();

                };


                grid.appendChild(c);

            });

        }


        function esc(s) {

            return s.replace(/[&<>'"]/g, c => ({

                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'

            } [c] || c));

        }


        function bytes(n) {

            if (!n) {
                return '0 B';
            }


            let u = ['B', 'KB', 'MB', 'GB'],
                i = Math.floor(
                    Math.log(n) / Math.log(1024)
                );


            return (
                    n / 1024 ** i
                ).toFixed(i ? 1 : 0) +
                ' ' +
                u[i];

        }


        document.querySelectorAll('.format-btn').forEach(b =>
            b.onclick = () => {

                document.querySelectorAll('.format-btn')
                    .forEach(x =>
                        x.classList.remove('active')
                    );

                b.classList.add('active');

                format = b.dataset.format;

            }
        );


        document.getElementById('clearAllBtn').onclick = () => {

            files = [];

            render();

        };


        function img(f) {

            return new Promise((res, rej) => {

                let i = new Image;

                i.onload = () => res(i);

                i.onerror = rej;

                i.src = URL.createObjectURL(f);

            });

        }


        function blob(i, t) {

            let c = document.createElement('canvas');

            c.width = i.naturalWidth;

            c.height = i.naturalHeight;


            let x = c.getContext('2d');


            if (t === 'jpg' || t === 'jpeg') {

                x.fillStyle = '#fff';

                x.fillRect(
                    0,
                    0,
                    c.width,
                    c.height
                );

            }


            x.drawImage(i, 0, 0);


            return new Promise(r =>
                c.toBlob(
                    r,
                    t === 'jpg' || t === 'jpeg' ?
                    'image/jpeg' :
                    'image/' + t,
                    .92
                )
            );

        }


        async function pdf() {

            const {
                jsPDF
            } = window.jspdf;


            const p = new jsPDF({
                unit: 'px',
                format: 'a4'
            });


            for (let n = 0; n < files.length; n++) {

                let i = await img(files[n]),
                    w = p.internal.pageSize.getWidth(),
                    h = p.internal.pageSize.getHeight(),
                    s = Math.min(
                        (w - 40) / i.width,
                        (h - 40) / i.height
                    ),
                    iw = i.width * s,
                    ih = i.height * s;


                if (n) {
                    p.addPage();
                }


                p.addImage(
                    i,
                    'JPEG',
                    (w - iw) / 2,
                    (h - ih) / 2,
                    iw,
                    ih,
                    '',
                    'FAST'
                );

            }


            return p.output('blob');

        }


        /*
         * Create one ZIP for multiple images
         */
        async function zipImages() {

            const zip = new JSZip();


            for (let i = 0; i < files.length; i++) {

                stat.textContent =
                    `Converting image ${i + 1} of ${files.length}...`;


                let im = await img(files[i]);

                let b = await blob(im, format);


                let fileName =
                    files[i].name.replace(/\.[^.]+$/, '') +
                    '.' +
                    format;


                zip.file(fileName, b);


                let p = Math.round(
                    ((i + 1) / files.length) * 100
                );


                bar.style.width = p + '%';

                pct.textContent = p + '%';

            }


            stat.textContent =
                'Creating ZIP file...';


            return await zip.generateAsync({

                type: 'blob',

                compression: 'DEFLATE',

                compressionOptions: {
                    level: 6
                }

            });

        }


        /*
         * Reset conversion modal
         */
        function resetConversionModal() {

            spinner.classList.remove('d-none');

            statusLabel.textContent = 'PROCESSING';

            conversionTitle.textContent =
                'Converting your images';

            stat.textContent =
                'Preparing your files...';

            progress.classList.remove('d-none');

            progressTextWrapper.classList.remove('d-none');

            bar.style.width = '0%';

            pct.textContent = '0%';

            downloadBtn.classList.add('d-none');

        }


        /*
         * Conversion completed state
         */
        function showCompletedState() {

            document.getElementById('closeConversionBtn').classList.remove('d-none');

            /*
             * Stop/hide loader
             */
            spinner.classList.add('d-none');

            /*
             * Update status
             */
            statusLabel.textContent = 'COMPLETED';

            conversionTitle.textContent =
                'Conversion completed Successfully';

            stat.textContent =
                'Your file is ready to download.';

            /*
             * Hide progress because processing is finished
             */
            progress.classList.add('d-none');

            progressTextWrapper.classList.add('d-none');

            /*
             * Show Download button
             */
            downloadBtn.classList.remove('d-none');

        }


        /*
         * Download button
         */
        downloadBtn.onclick = () => {

            if (!convertedBlob) {
                return;
            }


            if (convertedUrl) {

                URL.revokeObjectURL(convertedUrl);

            }


            convertedUrl =
                URL.createObjectURL(convertedBlob);


            const a =
                document.createElement('a');


            a.href = convertedUrl;

            a.download =
                convertedFileName;


            document.body.appendChild(a);

            a.click();

            a.remove();


            setTimeout(() => {

                if (convertedUrl) {

                    URL.revokeObjectURL(convertedUrl);

                    convertedUrl = null;

                }

            }, 1000);

        };


        /*
         * Convert Images
         */
        document.getElementById('convertBtn').onclick = async () => {

            if (!files.length) {
                return;
            }


            /*
             * Reset previous conversion
             */
            resetConversionModal();


            /*
             * Show loader
             */
            overlay.classList.add('show');


            convertedBlob = null;

            convertedFileName = '';


            try {


                /*
                 * PDF
                 */
                if (format === 'pdf') {

                    stat.textContent =
                        'Building your PDF...';


                    convertedBlob =
                        await pdf();


                    convertedFileName =
                        'pixelflow-converted.pdf';


                    bar.style.width = '100%';

                    pct.textContent = '100%';

                }


                /*
                 * Single image
                 */
                else if (files.length === 1) {

                    stat.textContent =
                        'Converting your image...';


                    let im =
                        await img(files[0]);


                    convertedBlob =
                        await blob(im, format);


                    convertedFileName =
                        files[0].name.replace(
                            /\.[^.]+$/,
                            ''
                        ) +
                        '.' +
                        format;


                    bar.style.width = '100%';

                    pct.textContent = '100%';

                }


                /*
                 * Multiple images
                 * Convert to one ZIP
                 */
                else {

                    convertedBlob =
                        await zipImages();


                    convertedFileName =
                        'pixelflow-converted-images.zip';

                }


                /*
                 * Show completed state
                 */
                showCompletedState();


            } catch (e) {

                console.error(e);


                spinner.classList.add('d-none');

                statusLabel.textContent =
                    'ERROR';

                conversionTitle.textContent =
                    'Conversion failed';

                stat.textContent =
                    'Something went wrong. Please try again.';

                progress.classList.add('d-none');

                progressTextWrapper.classList.add('d-none');

            }

        };


        document.getElementById('closeConversionBtn').onclick = () => {
            overlay.classList.remove('show');
        };
    </script>
    <script>
        const converterSeoCta = document.getElementById('converterSeoCta');
        const converterUpload = document.getElementById('converterUpload');
        const converterFilesPanel = document.getElementById('converterFilesPanel');

        if (converterSeoCta && converterUpload && converterFilesPanel) {
            converterSeoCta.addEventListener('click', function(event) {
                event.preventDefault();

                const target = converterUpload.classList.contains('d-none')
                    ? converterFilesPanel
                    : converterUpload;
                const reduceMotion = window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches;

                target.scrollIntoView({
                    behavior: reduceMotion ? 'auto' : 'smooth',
                    block: 'start'
                });
            });
        }
    </script>
@endsection


@section('scripts')
@endsection
