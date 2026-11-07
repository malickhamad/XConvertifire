  <!-- ========================================= -->
  <!-- Morphing Dynamic Navbar -->
  <!-- ========================================= -->
  <style>
      .brand-logo-img {
          height: auto !important;
          /* Text header height ke mutabiq adjustment */
          width: 170px !important;
          /* Aspect ratio maintain rakhne ke liye */
          object-fit: contain;
          display: block;
      }
  </style>


<style>
    .brand-logo-img {
        height: auto !important;
        width: 170px !important;
        object-fit: contain;
        display: block;
    }

    /* Tools dropdown: hidden by default, shows only when opened */
    #toolsDropdown .nav-dropdown-menu {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 6px;
        width: max-content;
        max-width: calc(100vw - 40px);
        padding: 14px;

        position: fixed !important;
        left: 50% !important;
        top: 80px !important;
        transform: translateX(-50%) translateY(8px) !important;

        border-radius: 16px !important;
        /* border: 1px solid rgba(59, 130, 246, 0.25); */
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5) !important;

        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
        z-index: 9999;
    }

    /* ✅ Invisible hover bridge: keeps dropdown open while moving to it */
    #toolsDropdown::after {
        content: "";
        position: fixed;
        top: 60px;
        left: 0;
        right: 0;
        height: 40px;
        pointer-events: none;
    }
    #toolsDropdown:hover::after {
        pointer-events: auto;
    }

    /* ✅ Show on hover / focus */
    #toolsDropdown:hover .nav-dropdown-menu,
    #toolsDropdown:focus-within .nav-dropdown-menu {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
        transform: translateX(-50%) translateY(0) !important;
    }

    /* Tool item */
    #toolsDropdown .nav-dropdown-menu a {
        display: flex !important;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        font-size: 13px;
        font-weight: 500;
        color: #cbd5e1 !important;
        text-decoration: none;
        border-radius: 10px;
        white-space: nowrap;
        transition: color 0.2s ease;
    }

    #toolsDropdown .nav-dropdown-menu a i {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #60a5fa;
        flex-shrink: 0;
        transition: color 0.2s ease;
    }

    #toolsDropdown .nav-dropdown-menu a:hover {
        color: #ffffff !important;
    }

    #toolsDropdown .nav-dropdown-menu a:hover i {
        color: #3b82f6;
    }

    /* Medium screens (md): 3 columns */
    @media (max-width: 1024px) {
        #toolsDropdown .nav-dropdown-menu {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            width: calc(100vw - 40px);
        }
    }

    /* Mobile: static list inside mobile menu */
    @media (max-width: 768px) {
        #toolsDropdown .nav-dropdown-menu {
            position: static !important;
            width: 100% !important;
            max-width: 100% !important;
            grid-template-columns: 1fr !important;
               padding: 0 !important;
            margin: 0 !important;
            transform: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            box-shadow: none !important;
            border-radius: 12px !important;
        }

        #toolsDropdown:hover .nav-dropdown-menu,
        #toolsDropdown:focus-within .nav-dropdown-menu {
            transform: none !important;
        }

        #toolsDropdown .nav-dropdown-menu a {
            width: 100% !important;
            box-sizing: border-box;
        }
    }
    /* Give the trigger a padding-bottom that fills the gap */
    .nav-item-dropdown {
        position: relative;
        padding-bottom: 0; /* default */
    }

    /* When navbar is fixed/shrunk, the trigger area extends down to the dropdown */
    .dynamic-navbar.scrolled .nav-item-dropdown,
    .dynamic-navbar.fixed .nav-item-dropdown,
    .dynamic-navbar.shrink .nav-item-dropdown,
    .dynamic-navbar.is-fixed .nav-item-dropdown {
        padding-bottom: 30px;   /* fills the gap */
        margin-bottom: -30px;   /* keeps layout unchanged */
    }
    .dynamic-navbar .nav-container {
    padding-left: 20px !important;
    padding-right: 20px !important;
}

.dynamic-navbar.scrolled #toolsDropdown .nav-dropdown-menu,
.dynamic-navbar.fixed #toolsDropdown .nav-dropdown-menu,
.dynamic-navbar.shrink #toolsDropdown .nav-dropdown-menu {
    top: 76px !important;
}

</style>



  <header class="dynamic-navbar" id="morphNavbar">
      <div class="nav-container">
          <!-- Left: Logo -->
          <a href="{{ route('home') }}" class="brand-logo">
              <img src="{{ asset('assets/images/logo.webp') }}" alt="Convertifire" class="brand-logo-img" width="512" height="167">
          </a>
          <!-- Center: Links Pill -->
          <nav class="nav-links-wrapper" id="navLinksWrapper" aria-label="Main navigation">
              <a href="{{ route('home') }}" class="nav-link-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

              <!-- Tools Dropdown -->
              <div class="nav-item-dropdown" id="toolsDropdown">
                  <a href="{{ route('home') }}#tools" class="nav-link-item active text-white dropdown-trigger">
                      Tools <i class="fas fa-chevron-down dropdown-caret"></i>
                  </a>
                  <div class="nav-dropdown-menu">
                      <a href="{{ route('image.compressor') }}"><i class="fas fa-compress-arrows-alt"></i> Compress
                          Image</a>
                      <a href="{{ route('image.resizer') }}"><i class="fas fa-expand-arrows-alt"></i> Resize Image</a>
                      <a href="{{ route('image.cropper') }}"><i class="fas fa-crop-alt"></i> Crop Image</a>
                      <a href="{{ route('image.rotator') }}"><i class="fas fa-sync-alt"></i> Rotate Image</a>
                      <a href="{{ route('image.converter') }}"><i class="fas fa-file-export"></i> Image Converter</a>
                      <a href="{{ route('video.to.audio') }}"><i class="fas fa-music"></i> Video to Audio</a>
                      <a href="{{ route('pdf.editor') }}"><i class="fas fa-file-pdf"></i> PDF Editor</a>
                      <a href="{{ route('image.background_remover') }}"><i class="fas fa-eraser"></i> Remove
                          Background</a>
                      <a href="{{ route('pdf.to.word') }}"><i class="fas fa-file-word"></i> PDF to Word</a>
                      <a href="{{ route('word.pdf.index') }}"><i class="fas fa-file-pdf"></i> Word to PDF</a>
                      {{-- <a href="#"><i class="fas fa-search-plus"></i> Upscale Image</a>
    <a href="#"><i class="fas fa-user-secret"></i> Blur Face</a> --}}
                  </div>
              </div>

              <a href="{{ route('about-us') }}" class="nav-link-item {{ request()->routeIs('about-us') ? 'active' : '' }}">About Us</a>
              <a href="{{ route('blog.index') }}" class="nav-link-item {{ request()->routeIs('blog.index') ? 'active' : '' }}">Blog</a>
              <a href="{{ route('contact') }}" class="nav-link-item {{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>

              {{-- <!-- API Docs Dropdown -->
              <div class="nav-item-dropdown" id="apiDropdown">
                  <a href="#" class="nav-link-item dropdown-trigger">
                      API Docs <i class="fas fa-chevron-down dropdown-caret"></i>
                  </a>
                  <div class="nav-dropdown-menu">
                      <a href="#"><i class="fas fa-book"></i> Getting Started</a>
                      <a href="#"><i class="fas fa-key"></i> Authentication</a>
                      <a href="#"><i class="fas fa-cloud-upload-alt"></i> Batch Processing</a>
                      <a href="#"><i class="fas fa-code"></i> API Reference</a>
                  </div>
              </div> --}}

          </nav>

          <!-- Right: Action Button (desktop) -->
          <a href="{{ route('contact') }}" class="btn-action">Request a Tool</a>

          <!-- Mobile Hamburger Toggle -->
          <button class="mobile-toggle-btn" id="mobileToggleBtn" aria-label="Toggle menu" aria-controls="navLinksWrapper" aria-expanded="false">
              <i class="fas fa-bars"></i>
          </button>
      </div>
  </header>
