@extends('components.app')

@section('meta')
    <title>About Us: FREE Online File Tools | XConvertifire</title>

    <meta name="description"
        content="Learn about XConvertifire and our mission to make file editing simple, private, and FREE with fast browser-based tools, no signup, and no hidden fees.">

    <meta property="og:title" content="About Us: FREE Online File Tools | XConvertifire">
    <meta property="og:description"
        content="Learn about XConvertifire and our mission to make file editing simple, private, and FREE with fast browser-based tools, no signup, and no hidden fees.">
@endsection

@section('content')

<style>
    /* Page-level overflow guard */
.about-hero,
.about-mission-section,
.about-video-section,
.about-offer-section,
.about-why-section {
    overflow-x: clip;
}
</style>
    <!-- ========================================= -->
    <!-- HERO SECTION (WITH VIDEO BACKGROUND) -->
    <!-- ========================================= -->
    <section class="about-hero">

        <!-- Background Video -->
      <video autoplay class="about-hero-bg-video" autoplay loop muted playsinline preload="metadata">
    <source src="{{ asset('assets/video/convertifire.mp4') }}" type="video/mp4">
</video>
        <!-- Overlay -->
        <div class="about-hero-overlay"></div>

        <!-- Glows -->
        <div class="about-hero-glow"></div>
        <div class="about-hero-glow-2"></div>

        <div class="container about-hero-content">
            <div class="row">
                <div class="col-lg-8">

                    <div data-aos="fade-right" data-aos-duration="1000">
                        <span class="tag-badge">
                            <i class="fas fa-bolt text-light me-2"></i> Our Story
                        </span>
                    </div>

                    <h1 class="about-hero-title" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        About XConvertifire
                    </h1>

                    <p class="about-hero-subtitle" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                        XConvertifire provides free online tools for common image, PDF, document, and video tasks.
                        Use supported tools to compress, resize, crop, rotate, or convert images; edit PDFs;
                        convert PDFs and Word documents; and extract audio from videos.
                    </p>

                    <div class="about-hero-stats" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
                        <div class="about-stat">
                            <h3>Image</h3>
                            <p>Tools</p>
                        </div>
                        <div class="about-stat">
                            <h3>PDF</h3>
                            <p>Tools</p>
                        </div>
                        <div class="about-stat">
                            <h3>Video</h3>
                            <p>Tools</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <!-- ========================================= -->
    <!-- MISSION SECTION -->
    <!-- ========================================= -->
    <section class="container about-mission-section">
        <div class="row g-4 align-items-center">

            <div class="col-lg-6" data-aos="fade-right">
                <span class="about-mini-badge">Our Mission</span>

                <h2 class="about-heading">
                    Make file editing <span>accessible to everyone</span>
                </h2>

                <p class="about-para">
                    Our tools are designed for everyday image, PDF, document, and video tasks.
                    Available tools are free to use, and processing features vary by tool.
                </p>

                <div class="about-points">
                    <div class="about-point">
                        <i class="fas fa-check-circle"></i>
                        <span>Free online tools for supported tasks</span>
                    </div>
                    <div class="about-point">
                        <i class="fas fa-check-circle"></i>
                        <span>Some tools process files in your browser; others require server-side processing</span>
                    </div>
                    <div class="about-point">
                        <i class="fas fa-check-circle"></i>
                        <span>Use the tools online without installing software</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                <div class="about-mission-card">
                    <div class="about-mission-glow"></div>

                    <div class="about-mini-card">
                        <div class="about-mini-icon bg-blue">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>File Processing</h4>
                        <p>
                            Some tools process files in your browser; others send files to our servers for
                            processing. See our
                            <a href="{{ route('privacy-policy') }}">Privacy Policy</a> for details.
                        </p>
                    </div>

                    <div class="about-mini-card">
                        <div class="about-mini-icon bg-green">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4>Processing Time</h4>
                        <p>Processing time depends on the tool, file, device, and connection.</p>
                    </div>

                    <div class="about-mini-card">
                        <div class="about-mini-icon bg-purple">
                            <i class="fas fa-infinity"></i>
                        </div>
                        <h4>Tool Limits</h4>
                        <p>File-size and usage limits may vary by tool; check the relevant tool page.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

     <!-- ========================================= -->
    <!-- VIDEO SHOWCASE - 3D EFFECT -->
    <!-- ========================================= -->
    <section class="container about-video-section">
        <div class="row align-items-center g-5">

            <!-- Left Content -->
            <div class="col-lg-5" data-aos="fade-right">
                <span class="about-mini-badge">See It In Action</span>

                <h2 class="about-heading">
                    Watch how <span>XConvertifire works</span>
                </h2>

                <p class="about-para">
                    See how to use XConvertifire's online tools. Available features and processing
                    methods vary by tool.
                </p>

                <div class="about-video-points">
                    <div class="about-video-point">
                        <div class="about-video-point-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h5>Processing Time</h5>
                            <p>Processing depends on the tool and file.</p>
                        </div>
                    </div>
                    <div class="about-video-point">
                        <div class="about-video-point-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h5>File Processing</h5>
                            <p>Some tools process files in your browser; others use server-side processing.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 3D Video -->
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                <div class="about-video-3d-wrap" id="video3dWrap">
                    <!-- Floating badges -->
                    <div class="about-video-float-badge about-video-float-1">
                        <i class="fas fa-check-circle"></i> Free Online Tools
                    </div>
                    <div class="about-video-float-badge about-video-float-2">
                        <i class="fas fa-bolt"></i> Fast
                    </div>

                    <!-- 3D Video Card -->
                    <div class="about-video-3d" id="video3dCard">
                       <video autoplay loop muted playsinline>
    <source src="{{ asset('assets/video/convertifire.mp4') }}" type="video/mp4">
</video>
                        <div class="about-video-3d-overlay"></div>
                    </div>

                    <!-- Glow behind -->
                    <div class="about-video-glow"></div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================= -->
    <!-- WHAT WE OFFER - BENTO GRID -->
    <!-- ========================================= -->
    <section class="container about-offer-section">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="about-mini-badge">What We Offer</span>
            <h2 class="about-heading mt-3">
                Online tools for <span>everyday file tasks</span>
            </h2>
            <p class="about-section-desc">
                Explore tools for common image, PDF, document, and video tasks.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="50">
                <a href="{{ route('image.compressor') }}" class="text-decoration-none">
                <div class="about-feature-card anim-border">
                    <div class="icon-box bg-blue"><i class="fas fa-image"></i></div>
                    <h5>Image Tools</h5>
                    <p>Compress, resize, crop, rotate, and convert supported image formats.</p>
                </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('video.to.audio') }}" class="text-decoration-none">
                <div class="about-feature-card anim-border">
                    <div class="icon-box bg-purple"><i class="fas fa-video"></i></div>
                    <h5>Video Tools</h5>
                    <p>Extract audio from video files with our video-to-audio tool.</p>
                </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                <a href="{{ route('pdf.editor') }}" class="text-decoration-none">
                <div class="about-feature-card anim-border">
                    <div class="icon-box bg-red"><i class="fas fa-file-pdf"></i></div>
                    <h5>PDF Tools</h5>
                    <p>Edit PDF text or convert PDFs to Word documents.</p>
                </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('word.pdf.index') }}" class="text-decoration-none">
                <div class="about-feature-card anim-border">
                    <div class="icon-box bg-green"><i class="fas fa-file-word"></i></div>
                    <h5>Document Tools</h5>
                    <p>Convert Word documents to PDF files.</p>
                </div>
                                </a>
            </div>

        </div>
        <p class="about-para mt-4">
            Need a Word document from a PDF? Explore our
            <a href="{{ route('pdf.to.word') }}">PDF to Word converter</a>
            and its supported features.
        </p>
    </section>


    <!-- ========================================= -->
    <!-- WHY CHOOSE US - BENTO -->
    <!-- ========================================= -->
    <section class="container about-why-section">
        <div class="row g-4">

            <!-- Big Card -->
            <div class="col-lg-6" data-aos="fade-up">
                <div class="about-why-big">
                    <span class="about-mini-badge">Why XConvertifire</span>
                    <h3 class="about-why-title">
                        Tools for everyday file tasks
                    </h3>
                    <p class="about-why-desc">
                        Use XConvertifire's free online tools for common image, PDF, document, and video tasks.
                        Available features and processing methods vary by tool.
                    </p>

                    <div class="about-why-stats">
                        <div class="about-why-stat">
                            <i class="fas fa-image"></i>
                            <div>
                                <h4>Images</h4>
                                <p>Compress, resize, crop, rotate, and convert supported formats</p>
                            </div>
                        </div>
                        <div class="about-why-stat">
                            <i class="fas fa-file-pdf"></i>
                            <div>
                                <h4>PDFs</h4>
                                <p>Edit text and convert to Word documents</p>
                            </div>
                        </div>
                        <div class="about-why-stat">
                            <i class="fas fa-video"></i>
                            <div>
                                <h4>Videos</h4>
                                <p>Extract audio from video files</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small Cards -->
            <div class="col-lg-6">
                <div class="row g-4 h-100">

                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="about-why-small">
                            <div class="about-why-icon bg-blue">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h4>File Processing</h4>
                                <p>Some tools process files in your browser; others require server-side processing.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                        <div class="about-why-small">
                            <div class="about-why-icon bg-green">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div>
                                <h4>Works Everywhere</h4>
                                <p>Use our tools on desktop, tablet, or mobile, with no installation required.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-why-small">
                            <div class="about-why-icon bg-purple">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div>
                                <h4>Contact Support</h4>
                                <p>For help using a tool, <a href="{{ route('contact') }}">contact us</a>.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>





    <!-- ========================================= -->
    <!-- PAGE STYLES -->
    <!-- ========================================= -->
    <style>
        /* ========================================= */
        /* ===== HERO (WITH VIDEO BACKGROUND) ===== */
        /* ========================================= */
        .about-hero {
            position: relative;
            padding: 220px 0 120px;
            overflow: hidden;
            background: #050505;
            display: flex;
            align-items: center;
        }

        /* Background video */
        .about-hero-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            z-index: 0;
            object-fit: cover;
            opacity: 0.22;
        }

        /* Dark gradient overlay */
        .about-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                rgba(5, 5, 5, 1) 0%,
                rgba(5, 5, 5, 0.85) 40%,
                rgba(5, 5, 5, 0.4) 100%);
            z-index: 1;
            pointer-events: none;
        }

        .about-hero-glow {
            position: absolute;
            top: -100px;
            left: 10%;
            width: 500px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25), transparent 70%);
            filter: blur(90px);
            pointer-events: none;
            z-index: 2;
        }

        .about-hero-glow-2 {
            position: absolute;
            bottom: -100px;
            right: 5%;
            width: 450px;
            height: 350px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.18), transparent 70%);
            filter: blur(90px);
            pointer-events: none;
            z-index: 2;
        }

        .about-hero-content {
            position: relative;
            z-index: 3;
        }

        .about-hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin: 0 0 25px;
            max-width: 850px;
            background: linear-gradient(to right, #ffffff, #71717a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-hero-subtitle {
            font-size: 1.15rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 650px;
            margin: 0 0 45px;
        }

        /* Stats */
        .about-hero-stats {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
        }

        .about-stat h3 {
            font-size: 2.4rem;
            font-weight: 800;
            color: #fff;
            margin: 0 0 4px;
            letter-spacing: -1px;
        }

        .about-stat p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0;
            letter-spacing: 0.5px;
        }


        /* ===== SECTION SPACING ===== */
        .about-mission-section {
            padding: 80px 0 100px;
        }

        .about-offer-section {
            padding: 20px 0 100px;
        }

        .about-why-section {
            padding: 20px 0 100px;
        }


        /* ===== MINI BADGE ===== */
        .about-mini-badge {
            display: inline-block;
            padding: 6px 16px;
            border: 1px solid var(--border-color);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.04);
            color: #d4d4d8;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }


        /* ===== HEADINGS ===== */
        .about-heading {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
            color: #fff;
            margin: 0 0 22px;
        }

        .about-heading span {
            background: linear-gradient(90deg, #ffffff, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-para {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.75;
            margin: 0 0 30px;
        }

        .about-section-desc {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }


        /* ===== MISSION POINTS ===== */
        .about-points {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .about-point {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d4d4d8;
            font-size: 0.92rem;
        }

        .about-point i {
            color: #4ade80;
            font-size: 0.95rem;
        }


        /* ===== MISSION CARD ===== */
        .about-mission-card {
            position: relative;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            overflow: hidden;
        }

        .about-mission-glow {
            position: absolute;
            top: -150px;
            right: -150px;
            width: 350px;
            height: 350px;
            background: rgba(59, 130, 246, 0.1);
            filter: blur(80px);
            pointer-events: none;
        }

        .about-mini-card {
            position: relative;
            padding: 22px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .about-mini-card:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .about-mini-card:first-child {
            padding-top: 0;
        }

        .about-mini-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 14px;
        }

        .about-mini-icon.bg-blue { background: rgba(59, 130, 246, 0.12); color: #60a5fa; }
        .about-mini-icon.bg-green { background: rgba(34, 197, 94, 0.12); color: #4ade80; }
        .about-mini-icon.bg-purple { background: rgba(168, 85, 247, 0.12); color: #c084fc; }

        .about-mini-card h4 {
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .about-mini-card p {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.6;
            margin: 0;
        }


        /* ===== FEATURE CARDS ===== */
        .about-feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 28px 24px;
            height: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .about-feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--hover-border);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
        }

        .about-feature-card h5 {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .about-feature-card p {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.55;
            margin: 0;
        }


        /* ===== WHY SECTION ===== */
        .about-why-big {
            height: 100%;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 45px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .about-why-title {
            color: #fff;
            font-size: 1.9rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.6px;
            margin: 0 0 20px;
        }

        .about-why-desc {
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.7;
            margin: 0 0 35px;
        }

        .about-why-stats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
        }

        .about-why-stat {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .about-why-stat i {
            color: #60a5fa;
            font-size: 1.3rem;
        }

        .about-why-stat h4 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .about-why-stat p {
            color: var(--text-muted);
            font-size: 0.72rem;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .about-why-small {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            padding: 24px 26px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            height: 100%;
            transition: all 0.3s ease;
        }

        .about-why-small:hover {
            border-color: var(--hover-border);
            transform: translateX(6px);
        }

        .about-why-icon {
            flex: 0 0 50px;
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .about-why-icon.bg-blue { background: rgba(59, 130, 246, 0.12); color: #60a5fa; }
        .about-why-icon.bg-green { background: rgba(34, 197, 94, 0.12); color: #4ade80; }
        .about-why-icon.bg-purple { background: rgba(168, 85, 247, 0.12); color: #c084fc; }

        .about-why-small h4 {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .about-why-small p {
            color: var(--text-muted);
            font-size: 0.82rem;
            line-height: 1.55;
            margin: 0;
        }


        /* ========================================= */
        /* ===== VIDEO SHOWCASE - 3D ===== */
        /* ========================================= */
        .about-video-section {
            padding: 60px 0 120px;
        }

        .about-video-points {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 35px;
        }

        .about-video-point {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .about-video-point-icon {
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(59, 130, 246, 0.12);
            color: #60a5fa;
            font-size: 1.05rem;
        }

        .about-video-point h5 {
            color: #fff;
            font-size: 0.98rem;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .about-video-point p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.55;
        }


        /* ===== 3D VIDEO WRAPPER ===== */
        .about-video-3d-wrap {
            position: relative;
            perspective: 1500px;
            perspective-origin: center;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about-video-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 80%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.3), transparent 65%);
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
            animation: videoGlowPulse 4s ease-in-out infinite;
        }

        @keyframes videoGlowPulse {
            0%, 100% {
                opacity: 0.7;
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1.08);
            }
        }


        /* ===== 3D VIDEO CARD ===== */
        .about-video-3d {
            position: relative;
            width: 100%;
            max-width: 720px;
            aspect-ratio: 16 / 10;
            border-radius: 22px;
            overflow: hidden;
            background: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow:
                0 40px 80px -20px rgba(0, 0, 0, 0.8),
                0 25px 50px -12px rgba(59, 130, 246, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            transform-style: preserve-3d;
            transform: rotateY(-12deg) rotateX(6deg);
            transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1),
                        box-shadow 0.8s ease;
            z-index: 1;
        }

        .about-video-3d-wrap:hover .about-video-3d {
            transform: rotateY(-4deg) rotateX(2deg) translateY(-8px) scale(1.02);
            box-shadow:
                0 50px 100px -20px rgba(0, 0, 0, 0.85),
                0 30px 60px -12px rgba(59, 130, 246, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        }

        .about-video-3d video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .about-video-3d-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(59, 130, 246, 0.15) 0%,
                transparent 40%,
                transparent 60%,
                rgba(168, 85, 247, 0.1) 100%);
            pointer-events: none;
            z-index: 2;
        }

        .about-video-3d::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(180deg,
                rgba(255, 255, 255, 0.08) 0%,
                transparent 100%);
            pointer-events: none;
            z-index: 3;
            border-radius: 22px 22px 0 0;
        }


        /* ===== FLOATING BADGES ===== */
        .about-video-float-badge {
            position: absolute;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            z-index: 10;
            animation: floatBadge 4s ease-in-out infinite;
            pointer-events: none;
        }

        .about-video-float-badge i {
            color: #60a5fa;
            font-size: 0.85rem;
        }

        .about-video-float-1 {
            top: 20px;
            left: 0;
            animation-delay: 0s;
        }

        .about-video-float-2 {
            bottom: 40px;
            right: 0;
            animation-delay: 2s;
        }

        @keyframes floatBadge {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }


        /* ========================================= */
        /* ===== RESPONSIVE ===== */
        /* ========================================= */
        @media (max-width: 991px) {
            .about-hero {
                padding: 200px 0 100px;
            }

            .about-hero-title {
                font-size: 3rem;
            }

            .about-heading {
                font-size: 2.1rem;
            }

            .about-why-title {
                font-size: 1.6rem;
            }

            .about-mission-card {
                padding: 32px 28px;
            }

            .about-why-big {
                padding: 35px 30px;
            }

            .about-video-3d {
                transform: rotateY(-6deg) rotateX(3deg);
            }

            .about-video-3d-wrap {
                padding: 30px 10px;
            }
        }

        @media (max-width: 767px) {
            .about-hero {
                padding: 170px 0 80px;
            }

            .about-hero-title {
                font-size: 2.3rem;
                letter-spacing: -1px;
            }

            .about-hero-subtitle {
                font-size: 1rem;
            }

            .about-hero-stats {
                gap: 30px;
            }

            .about-stat h3 {
                font-size: 1.8rem;
            }

            .about-heading {
                font-size: 1.7rem;
            }

            .about-para {
                font-size: 0.92rem;
            }

            .about-mission-section,
            .about-offer-section,
            .about-why-section,
            .about-video-section {
                padding-bottom: 70px;
            }

            .about-mission-card,
            .about-why-big {
                padding: 28px 22px;
                border-radius: 20px;
            }

            .about-why-title {
                font-size: 1.4rem;
            }

            .about-why-stats {
                gap: 20px;
            }

            .about-feature-card {
                padding: 24px 20px;
            }

            /* Video section mobile */
            .about-video-3d {
                transform: none;
            }

            .about-video-3d-wrap {
                padding: 20px 0;
            }

            .about-video-float-badge {
                padding: 8px 14px;
                font-size: 0.7rem;
            }

            .about-video-float-1 {
                top: 10px;
                left: 10px;
            }

            .about-video-float-2 {
                bottom: 10px;
                right: 10px;
            }
        }
    </style>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrap = document.getElementById('video3dWrap');
            const card = document.getElementById('video3dCard');

            if (!wrap || !card) return;

            // Disable 3D tracking on mobile (touch devices)
            const isTouchDevice = window.matchMedia('(hover: none)').matches;
            if (isTouchDevice) return;

            let rafId = null;

            wrap.addEventListener('mousemove', function(e) {
                if (rafId) cancelAnimationFrame(rafId);

                rafId = requestAnimationFrame(function() {
                    const rect = wrap.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;

                    const rotateY = x * 18;
                    const rotateX = -y * 18;

                    card.style.transform =
                        `rotateY(${rotateY}deg) rotateX(${rotateX}deg) scale(1.03)`;
                    card.style.transition = 'transform 0.15s ease-out';
                });
            });

            wrap.addEventListener('mouseleave', function() {
                if (rafId) cancelAnimationFrame(rafId);
                card.style.transition = 'transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)';
                card.style.transform = 'rotateY(-12deg) rotateX(6deg)';
            });
        });
    </script>
@endsection
