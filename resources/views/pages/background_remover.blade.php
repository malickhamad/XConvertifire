@extends('components.app')

@section('canonical', 'https://xconvertifire.com/background-remover')

@section('meta')
    <title>FREE Background Remover: Erase Background | XConvertifire</title>
    <meta name="description"
        content="Remove image backgrounds for FREE with XConvertifire. Create clean AI cutouts, refine edges, add backgrounds, and download polished images quickly and securely.">
    <meta property="og:title" content="FREE Background Remover: Erase Background | XConvertifire">
    <meta property="og:description"
        content="Remove image backgrounds for FREE with XConvertifire. Create clean AI cutouts, refine edges, add backgrounds, and download polished images quickly and securely.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('image.background_remover') }}">
    <meta property="og:site_name" content="XConvertifire">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="XConvertifire logo">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FREE Background Remover: Erase Background | XConvertifire">
    <meta name="twitter:description"
        content="Remove image backgrounds for FREE with XConvertifire. Create clean AI cutouts, refine edges, add backgrounds, and download polished images quickly and securely.">
    <meta name="twitter:url" content="{{ route('image.background_remover') }}">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">
    <meta name="twitter:image:alt" content="XConvertifire logo">
@endsection

@section('content')
    <style>
        /* =========================================================
           X Convertifire AI Background Remover - editor styles
           (upload section uses the shared crop-* classes)
        ========================================================== */

        .bgx-section {
            padding: 24px 0 64px;
        }

        .bgx-editor {
            max-width: 1360px;
            margin: 0 auto;
            background: linear-gradient(180deg, #131315 0%, #0f0f11 100%);
            border: 1px solid #1f1f23;
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .55), inset 0 1px 0 rgba(255, 255, 255, .04);
            overflow: hidden;
            color: #f4f4f5;
        }

        .bgx-editor.drag-active {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .2), 0 25px 60px rgba(0, 0, 0, .55);
        }

        /* ---------- Top bar ---------- */
        .bgx-top {
            display: flex;
            align-items: center;
            gap: 12px;
            height: 66px;
            padding: 0 18px;
            border-bottom: 1px solid #1f1f23;
            background: rgba(255, 255, 255, .015);
        }

        .bgx-file {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .bgx-file-ico {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: rgba(59, 130, 246, .12);
            border: 1px solid rgba(59, 130, 246, .25);
            color: #60a5fa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bgx-file-text {
            min-width: 0;
        }

        .bgx-file-text strong,
        .bgx-file-text small {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 340px;
        }

        .bgx-file-text strong {
            font-size: .85rem;
            font-weight: 650;
            color: #fff;
        }

        .bgx-file-text small {
            font-size: .72rem;
            color: #71717a;
            margin-top: 2px;
        }

        .bgx-top-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bgx-icon-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
            padding: 0 14px;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 10px;
            color: #a1a1aa;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
            font-family: inherit;
            user-select: none;
            -webkit-user-select: none;
        }

        .bgx-icon-btn:hover:not(:disabled) {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .bgx-icon-btn:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .bgx-icon-btn.square {
            width: 40px;
            padding: 0;
            justify-content: center;
        }

        .bgx-download {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            height: 40px;
            padding: 0 20px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 20px rgba(59, 130, 246, .3), inset 0 1px 0 rgba(255, 255, 255, .15);
            transition: all .25s cubic-bezier(.4, 0, .2, 1);
        }

        .bgx-download:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(59, 130, 246, .42), inset 0 1px 0 rgba(255, 255, 255, .2);
        }

        /* ---------- Body layout ---------- */
        .bgx-body {
            display: grid;
            grid-template-columns: 86px 340px minmax(0, 1fr);
            height: clamp(580px, calc(100vh - 230px), 780px);
        }

        /* ---------- Rail ---------- */
        .bgx-rail {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 12px 9px;
            border-right: 1px solid #1f1f23;
            background: #0c0c0e;
            overflow-y: auto;
        }

        .bgx-rail-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            padding: 13px 4px 11px;
            border: 0;
            border-radius: 14px;
            background: transparent;
            color: #8b8b94;
            font-size: .68rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s ease;
        }

        .bgx-rail-btn i {
            font-size: 1.15rem;
        }

        .bgx-rail-btn:hover {
            background: rgba(255, 255, 255, .05);
            color: #e4e4e7;
        }

        .bgx-rail-btn.active {
            background: rgba(59, 130, 246, .14);
            color: #60a5fa;
        }

        /* ---------- Panel ---------- */
        .bgx-panel {
            border-right: 1px solid #1f1f23;
            background: #101012;
            overflow-y: auto;
            padding: 24px 22px 28px;
        }

        .bgx-panel::-webkit-scrollbar,
        .bgx-stage::-webkit-scrollbar,
        .bgx-rail::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .bgx-panel::-webkit-scrollbar-thumb,
        .bgx-stage::-webkit-scrollbar-thumb,
        .bgx-rail::-webkit-scrollbar-thumb {
            background: #2a2a2e;
            border-radius: 8px;
        }

        .bgx-panel-view {
            display: none;
        }

        .bgx-panel-view.active {
            display: block;
        }

        .bgx-panel-head h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 6px;
            letter-spacing: -.2px;
        }

        .bgx-panel-head p {
            font-size: .8rem;
            color: #71717a;
            line-height: 1.55;
            margin: 0 0 24px;
        }

        .bgx-label {
            display: block;
            font-size: .78rem;
            font-weight: 650;
            color: #d4d4d8;
            margin: 0 0 12px;
        }

        .bgx-section-gap {
            margin-top: 26px;
        }

        /* ---------- Brush cards (Canva style) ---------- */
        .bgx-brush-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .bgx-brush-card {
            display: flex;
            flex-direction: column;
            padding: 0;
            background: #18181b;
            border: 2px solid #27272a;
            border-radius: 14px;
            overflow: hidden;
            cursor: pointer;
            font-family: inherit;
            color: #a1a1aa;
            transition: all .2s ease;
        }

        .bgx-brush-card:hover {
            border-color: #3f3f46;
        }

        .bgx-brush-card.active {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .16);
            color: #fff;
        }

        .bgx-brush-thumb {
            position: relative;
            height: 112px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1c1c20;
            background-image: linear-gradient(45deg, #26262b 25%, transparent 25%), linear-gradient(-45deg, #26262b 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #26262b 75%), linear-gradient(-45deg, transparent 75%, #26262b 75%);
            background-size: 16px 16px;
            background-position: 0 0, 0 8px, 8px -8px, -8px 0;
        }

        .bgx-brush-thumb img {
            max-width: 88%;
            max-height: 88%;
            object-fit: contain;
            display: block;
        }

        .bgx-brush-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #0a0a0a;
            color: #0a0a0a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .45);
        }

        .bgx-brush-name {
            padding: 11px 0 12px;
            text-align: center;
            font-size: .78rem;
            font-weight: 650;
            border-top: 1px solid #27272a;
            background: #141417;
        }

        /* ---------- Range / number rows ---------- */
        .bgx-row {
            margin-top: 24px;
        }

        .bgx-row-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .bgx-row-head label {
            font-size: .78rem;
            font-weight: 650;
            color: #d4d4d8;
            margin: 0;
        }

        .bgx-row-head output {
            font-size: .78rem;
            font-weight: 700;
            color: #fff;
            font-variant-numeric: tabular-nums;
        }

        .bgx-num {
            width: 64px;
            height: 34px;
            text-align: center;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 8px;
            color: #fff;
            font-size: .82rem;
            font-weight: 650;
            font-family: inherit;
            -moz-appearance: textfield;
        }

        .bgx-num::-webkit-outer-spin-button,
        .bgx-num::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .bgx-num:focus {
            outline: none;
            border-color: rgba(59, 130, 246, .6);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
        }

        .bgx-range {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 5px;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            background: linear-gradient(90deg, #3b82f6 var(--p, 30%), #2a2a2e var(--p, 30%));
        }

        .bgx-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .5);
            cursor: pointer;
        }

        .bgx-range::-moz-range-thumb {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .5);
            cursor: pointer;
        }

        .bgx-range::-moz-range-track {
            background: transparent;
        }

        /* ---------- Switch ---------- */
        .bgx-switch-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 26px;
        }

        .bgx-switch-row b {
            display: block;
            font-size: .78rem;
            font-weight: 650;
            color: #d4d4d8;
        }

        .bgx-switch-row small {
            display: block;
            font-size: .72rem;
            color: #71717a;
            margin-top: 3px;
            line-height: 1.45;
        }

        .bgx-switch {
            position: relative;
            width: 44px;
            height: 25px;
            flex-shrink: 0;
            display: inline-block;
        }

        .bgx-switch input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .bgx-switch .bgx-knob {
            position: absolute;
            inset: 0;
            border-radius: 25px;
            background: #34343a;
            transition: background .2s ease;
        }

        .bgx-switch .bgx-knob::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 19px;
            height: 19px;
            border-radius: 50%;
            background: #fff;
            transition: transform .2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .4);
        }

        .bgx-switch input:checked+.bgx-knob {
            background: #3b82f6;
        }

        .bgx-switch input:checked+.bgx-knob::after {
            transform: translateX(19px);
        }

        .bgx-divider {
            height: 1px;
            background: #1f1f23;
            margin: 26px 0 0;
        }

        .bgx-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            margin-top: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 11px;
            color: #b4b4bc;
            font-size: .82rem;
            font-weight: 650;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s ease;
        }

        .bgx-btn:hover {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .bgx-btn.active {
            background: linear-gradient(135deg, rgba(59, 130, 246, .2), rgba(139, 92, 246, .14));
            border-color: rgba(59, 130, 246, .5);
            color: #60a5fa;
        }

        /* ---------- Background swatches ---------- */
        .bgx-swatches {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .bgx-swatch {
            position: relative;
            aspect-ratio: 1 / 1;
            border-radius: 11px;
            border: 2px solid #27272a;
            cursor: pointer;
            padding: 0;
            overflow: hidden;
            transition: transform .15s ease, border-color .15s ease;
        }

        .bgx-swatch:hover {
            transform: scale(1.06);
        }

        .bgx-swatch.active {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .25);
        }

        .bgx-swatch.transparent {
            background-color: #1c1c20;
            background-image: linear-gradient(45deg, #2e2e34 25%, transparent 25%), linear-gradient(-45deg, #2e2e34 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #2e2e34 75%), linear-gradient(-45deg, transparent 75%, #2e2e34 75%);
            background-size: 12px 12px;
            background-position: 0 0, 0 6px, 6px -6px, -6px 0;
        }

        .bgx-swatch.light {
            border-color: #3f3f46;
        }

        .bgx-color-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .bgx-color-row span {
            font-size: .8rem;
            color: #a1a1aa;
            font-weight: 600;
        }

        .bgx-color-input {
            width: 56px;
            height: 36px;
            padding: 3px;
            background: #18181b;
            border: 1px solid #333;
            border-radius: 9px;
            cursor: pointer;
        }

        /* ---------- Effect cards ---------- */
        .bgx-card {
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 14px;
            transition: border-color .2s ease;
        }

        .bgx-card.on {
            border-color: rgba(59, 130, 246, .45);
        }

        .bgx-card-head {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bgx-card-ico {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(59, 130, 246, .12);
            color: #60a5fa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bgx-card-head>div:nth-child(2) {
            flex: 1;
            min-width: 0;
        }

        .bgx-card-head b {
            display: block;
            font-size: .82rem;
            color: #fff;
            font-weight: 650;
        }

        .bgx-card-head small {
            display: block;
            font-size: .72rem;
            color: #71717a;
            margin-top: 2px;
        }

        .bgx-card-body {
            display: none;
            padding-top: 4px;
        }

        .bgx-card.on .bgx-card-body {
            display: block;
        }

        .bgx-card-body .bgx-row:first-child {
            margin-top: 20px;
        }

        .bgx-card-body .bgx-row {
            margin-top: 18px;
        }

        /* ---------- Stage ---------- */
        .bgx-stage-col {
            display: flex;
            flex-direction: column;
            min-width: 0;
            min-height: 0;
        }

        .bgx-stage-bar {
            height: 50px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            border-bottom: 1px solid #1f1f23;
            font-size: .78rem;
            color: #8b8b94;
        }

        .bgx-status {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .bgx-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px #4ade80;
        }

        .bgx-zoom {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bgx-zoom button {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .04);
            color: #a1a1aa;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s ease;
        }

        .bgx-zoom button:hover {
            color: #fff;
            background: rgba(255, 255, 255, .09);
        }

        .bgx-zoom span {
            min-width: 48px;
            text-align: center;
            font-variant-numeric: tabular-nums;
            color: #d4d4d8;
            font-weight: 600;
        }

        .bgx-stage {
            position: relative;
            flex: 1 1 0;
            min-height: 0;
            display: flex;
            overflow: auto;
            padding: 28px;
            background: #09090b;
        }

        .bgx-canvas {
            display: block;
            flex-shrink: 0;
            margin: auto;
            cursor: none;
            touch-action: none;
            border-radius: 4px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .55);
            background-color: #141416;
            background-image: linear-gradient(45deg, #1f1f23 25%, transparent 25%), linear-gradient(-45deg, #1f1f23 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #1f1f23 75%), linear-gradient(-45deg, transparent 75%, #1f1f23 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0;
        }

        .bgx-cursor {
            position: fixed;
            z-index: 10000;
            pointer-events: none;
            display: none;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, .6), inset 0 0 0 1px rgba(0, 0, 0, .35);
            transform: translate(-50%, -50%);
        }

        .bgx-cursor.restore {
            border-color: #60a5fa;
        }

        .bgx-foot {
            height: 56px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0 16px;
            border-top: 1px solid #1f1f23;
        }

        .bgx-foot-tip {
            font-size: .74rem;
            color: #71717a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bgx-foot-tip i {
            color: #60a5fa;
        }

        .bgx-new-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 10px;
            color: #a1a1aa;
            font-size: .78rem;
            font-weight: 650;
            cursor: pointer;
            font-family: inherit;
            transition: all .25s cubic-bezier(.4, 0, .2, 1);
        }

        .bgx-new-btn:hover {
            background: rgba(59, 130, 246, .12);
            border-color: rgba(59, 130, 246, .4);
            color: #60a5fa;
        }

        /* ---------- Processing overlay ---------- */
        .processing-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .68);
            backdrop-filter: blur(18px);
            opacity: 0;
            visibility: hidden;
            transition: .25s
        }

        .processing-overlay.show {
            opacity: 1;
            visibility: visible
        }

        .processing-card {
            width: min(410px, calc(100% - 30px));
            background: #111;
            border: 1px solid #333;
            border-radius: 20px;
            padding: 34px;
            text-align: center;
            box-shadow: 0 35px 100px #000
        }

        .ai-loader {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 2px solid #222;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #60a5fa
        }

        .ai-loader span {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 2px solid transparent;
            border-top-color: #3b82f6;
            border-right-color: #60a5fa;
            animation: bgxspin .8s linear infinite
        }

        .ai-loader i {
            font-size: 1.25rem
        }

        .processing-label {
            font-size: .59rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #60a5fa
        }

        .processing-card h3 {
            font-size: 1.15rem;
            margin: 8px 0;
            color: #fff
        }

        .processing-card p {
            font-size: .7rem;
            color: #666;
            margin-bottom: 20px
        }

        .progress-track {
            height: 6px;
            background: #242424;
            border-radius: 10px;
            overflow: hidden
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background: #3b82f6;
            transition: width .2s
        }

        .progress-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 9px;
            font-size: .6rem;
            color: #666
        }

        .progress-meta strong {
            color: #60a5fa
        }

        @keyframes bgxspin {
            to {
                transform: rotate(360deg)
            }
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 991px) {
            .bgx-body {
                display: flex;
                flex-direction: column;
                height: auto;
            }

            .bgx-rail {
                order: 1;
                flex-direction: row;
                overflow-x: auto;
                overflow-y: hidden;
                border-right: 0;
                border-bottom: 1px solid #1f1f23;
                padding: 8px;
            }

            .bgx-rail-btn {
                flex: 1 0 auto;
                min-width: 76px;
                padding: 10px 8px;
            }

            .bgx-stage-col {
                order: 2;
                height: 480px;
            }

            .bgx-panel {
                order: 3;
                border-right: 0;
                border-top: 1px solid #1f1f23;
                overflow: visible;
            }
        }

        @media (max-width: 600px) {
            .bgx-section {
                padding-top: 12px;
            }

            .bgx-editor {
                border-radius: 18px;
            }

            .bgx-top {
                height: 60px;
                padding: 0 12px;
                gap: 8px;
            }

            .bgx-file-text small,
            .bgx-icon-btn span {
                display: none;
            }

            .bgx-icon-btn {
                width: 38px;
                padding: 0;
                justify-content: center;
                height: 38px;
            }

            .bgx-download {
                height: 38px;
                padding: 0 14px;
            }

            .bgx-file-text strong {
                max-width: 110px;
            }

            .bgx-stage {
                padding: 14px;
            }

            .bgx-stage-col {
                height: 400px;
            }

            .bgx-foot-tip {
                display: none;
            }

            .bgx-swatches {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        /* ---------- SEO section ---------- */
        .background-remover-seo-section {
            padding: 64px 20px 80px;
            border-top: 1px solid #262626;
            background: #0b0b0b
        }

        .background-remover-seo-section .seo-content {
            max-width: 960px;
            margin: 0 auto
        }

        .background-remover-seo-section h2 {
            margin: 42px 0 16px;
            color: #f4f4f5;
            font-size: clamp(1.45rem, 3vw, 2rem);
            font-weight: 750;
            line-height: 1.25
        }

        .background-remover-seo-section h2:first-child {
            margin-top: 0
        }

        .background-remover-seo-section h3 {
            margin: 26px 0 10px;
            color: #e4e4e7;
            font-size: 1.15rem;
            font-weight: 700
        }

        .background-remover-seo-section p,
        .background-remover-seo-section li {
            color: #b8b8c0;
            font-size: 1rem;
            line-height: 1.8
        }

        .background-remover-seo-section p {
            margin: 0 0 16px
        }

        .background-remover-seo-section ul,
        .background-remover-seo-section ol {
            padding-left: 1.4rem;
            margin: 0 0 20px
        }

        .background-remover-seo-section li {
            padding-left: 4px;
            margin: 0 0 8px
        }

        .background-remover-seo-section a {
            color: #93c5fd;
            text-decoration: underline;
            text-decoration-color: rgba(147, 197, 253, .45);
            text-underline-offset: 3px
        }

        .background-remover-seo-section a:hover {
            color: #bfdbfe;
            text-decoration-color: currentColor
        }

        .background-remover-seo-section .seo-faq-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px
        }

        .background-remover-seo-section .seo-faq-list details {
            padding: 17px 18px;
            border: 1px solid #292929;
            border-radius: 12px;
            background: #111
        }

        .background-remover-seo-section .seo-faq-list summary {
            color: #f4f4f5;
            font-weight: 650;
            line-height: 1.5;
            cursor: pointer
        }

        .background-remover-seo-section .seo-faq-list p {
            margin: 12px 0 0;
            font-size: .95rem
        }

        .background-remover-seo-section .seo-cta {
            margin-top: 48px;
            padding: 28px;
            border: 1px solid rgba(59, 130, 246, .35);
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(37, 99, 235, .14), rgba(17, 24, 39, .55));
            text-align: center
        }

        .background-remover-seo-section .seo-cta h2 {
            margin: 0 0 10px
        }

        .background-remover-seo-section .seo-cta-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            margin-top: 8px;
            padding: 0 20px;
            border-radius: 9px;
            background: #2563eb;
            color: #fff;
            font-weight: 700;
            text-decoration: none
        }

        .background-remover-seo-section .seo-cta-link:hover {
            background: #1d4ed8;
            color: #fff
        }

        @media (max-width: 640px) {
            .background-remover-seo-section {
                padding: 44px 16px 56px
            }

            .background-remover-seo-section .seo-faq-list {
                grid-template-columns: 1fr
            }

            .background-remover-seo-section .seo-cta {
                padding: 22px 18px
            }
        }
    </style>

    <main class="crop-page">

        <!-- BREADCRUMB -->
        <section class="crop-breadcrumb-section">
            <div class="container">
                <div class="crop-breadcrumb">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span>Background Remover</span>
                </div>
            </div>
        </section>

        <!-- UPLOAD SECTION (hidden after upload) -->
        <section class="crop-hero-section" id="uploadShell">
            <div class="container">

                <div class="crop-heading">
                    <span class="crop-small-badge">
                        <i class="fas fa-wand-magic-sparkles"></i>
                        AI Tool
                    </span>

                    <h1>
                        AI Background Remover<br>
                        <span>Online.</span>
                    </h1>

                    <p>
                        Remove backgrounds with AI, then refine every edge
                        with professional editing tools.
                    </p>
                </div>

                <div class="crop-upload-box cursor-pointer" id="uploadBox"
                    onclick="document.getElementById('imageInput').click()">

                    <div class="crop-upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>

                    <h3>Upload your image</h3>

                    <p class="crop-upload-text">
                        Drag & drop your image here or
                    </p>

                    <label for="imageInput" class="crop-upload-btn">
                        <i class="fas fa-upload"></i>
                        Choose File
                    </label>

                    <input type="file" id="imageInput" accept="image/png,image/jpeg,image/webp,image/gif" hidden>

                    <p class="crop-upload-info">
                        Supports JPG, PNG, WebP, GIF
                        <span>|</span>
                        Max size: 50MB
                    </p>

                </div>

            </div>
        </section>

        <!-- EDITOR SECTION (hidden until the cutout is ready) -->
        <section class="bgx-section" id="editorSection" style="display:none">
            <div class="container-fluid px-lg-4">

                <div class="bgx-editor" id="designEditor">

                    <!-- Top bar -->
                    <div class="bgx-top">
                        <div class="bgx-file">
                            <span class="bgx-file-ico"><i class="fas fa-image"></i></span>
                            <div class="bgx-file-text">
                                <strong id="fileName">No image selected</strong>
                                <small id="fileInfo">-</small>
                            </div>
                        </div>
                        <div class="bgx-top-actions">
                            <button type="button" class="bgx-icon-btn" id="compareBtn" title="Press and hold to see the original">
                                <i class="fas fa-eye"></i><span>Original</span>
                            </button>
                            <button type="button" class="bgx-icon-btn square" id="undoBtn" title="Undo (Ctrl+Z)">
                                <i class="fas fa-rotate-left"></i>
                            </button>
                            <button type="button" class="bgx-icon-btn square" id="redoBtn" title="Redo (Ctrl+Y)">
                                <i class="fas fa-rotate-right"></i>
                            </button>
                            <button type="button" class="bgx-download" id="downloadTop">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </div>
                    </div>

                    <div class="bgx-body">

                        <!-- Rail -->
                        <nav class="bgx-rail">
                            <button type="button" class="bgx-rail-btn active" data-panel="cutout">
                                <i class="fas fa-wand-magic-sparkles"></i>Cutout
                            </button>
                            <button type="button" class="bgx-rail-btn" data-panel="background">
                                <i class="fas fa-palette"></i>Background
                            </button>
                            <button type="button" class="bgx-rail-btn" data-panel="effects">
                                <i class="fas fa-clone"></i>Effects
                            </button>
                            <button type="button" class="bgx-rail-btn" data-panel="adjust">
                                <i class="fas fa-sliders"></i>Adjust
                            </button>
                            <button type="button" class="bgx-rail-btn" data-panel="transform">
                                <i class="fas fa-up-down-left-right"></i>Transform
                            </button>
                        </nav>

                        <!-- Panel -->
                        <aside class="bgx-panel">

                            <!-- CUTOUT -->
                            <div class="bgx-panel-view active" id="panel-cutout">
                                <div class="bgx-panel-head">
                                    <h3>Background remover</h3>
                                    <p>Paint over the image to erase leftovers or bring back parts the AI removed.</p>
                                </div>

                                <span class="bgx-label">Select a brush</span>
                                <div class="bgx-brush-grid">
                                    <button type="button" class="bgx-brush-card active" data-tool="erase">
                                        <span class="bgx-brush-thumb">
                                            <img class="bgx-thumb-img" alt="" src="">
                                            <span class="bgx-brush-badge"><i class="fas fa-minus"></i></span>
                                        </span>
                                        <span class="bgx-brush-name">Erase</span>
                                    </button>
                                    <button type="button" class="bgx-brush-card" data-tool="restore">
                                        <span class="bgx-brush-thumb">
                                            <img class="bgx-thumb-img" alt="" src="">
                                            <span class="bgx-brush-badge"><i class="fas fa-plus"></i></span>
                                        </span>
                                        <span class="bgx-brush-name">Restore</span>
                                    </button>
                                </div>

                                <div class="bgx-row">
                                    <div class="bgx-row-head">
                                        <label for="brushSize">Brush size</label>
                                        <input type="number" class="bgx-num" id="brushNum" min="5" max="200" value="40">
                                    </div>
                                    <input type="range" class="bgx-range" id="brushSize" min="5" max="200" value="40">
                                </div>

                                <div class="bgx-switch-row">
                                    <div>
                                        <b>Show original image</b>
                                        <small>Removed areas appear faded so you can restore them precisely.</small>
                                    </div>
                                    <label class="bgx-switch">
                                        <input type="checkbox" id="showOriginal">
                                        <span class="bgx-knob"></span>
                                    </label>
                                </div>

                                <div class="bgx-divider"></div>
                                <button type="button" class="bgx-btn" id="resetCutout">
                                    <i class="fas fa-rotate-left"></i> Reset to AI result
                                </button>
                            </div>

                            <!-- BACKGROUND -->
                            <div class="bgx-panel-view" id="panel-background">
                                <div class="bgx-panel-head">
                                    <h3>Background</h3>
                                    <p>Pick a new backdrop. You see it live and it is included in the download.</p>
                                </div>

                                <span class="bgx-label">Colors</span>
                                <div class="bgx-swatches" id="colorSwatches">
                                    <button type="button" class="bgx-swatch transparent active" data-bg="transparent" title="Transparent"></button>
                                    <button type="button" class="bgx-swatch light" data-bg="#ffffff" style="background:#ffffff" title="White"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#000000" style="background:#000000" title="Black"></button>
                                    <button type="button" class="bgx-swatch light" data-bg="#f4f4f5" style="background:#f4f4f5" title="Light gray"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#111827" style="background:#111827" title="Dark"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#3b82f6" style="background:#3b82f6" title="Blue"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#10b981" style="background:#10b981" title="Green"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#f59e0b" style="background:#f59e0b" title="Amber"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#ef4444" style="background:#ef4444" title="Red"></button>
                                    <button type="button" class="bgx-swatch" data-bg="#8b5cf6" style="background:#8b5cf6" title="Violet"></button>
                                </div>

                                <div class="bgx-section-gap">
                                    <span class="bgx-label">Gradients</span>
                                    <div class="bgx-swatches" id="gradientSwatches">
                                        <button type="button" class="bgx-swatch" data-bg="grad:blue" style="background:linear-gradient(135deg,#3b82f6,#8b5cf6)" title="Blue to violet"></button>
                                        <button type="button" class="bgx-swatch" data-bg="grad:sunset" style="background:linear-gradient(135deg,#f59e0b,#ef4444)" title="Sunset"></button>
                                        <button type="button" class="bgx-swatch" data-bg="grad:ocean" style="background:linear-gradient(135deg,#06b6d4,#2563eb)" title="Ocean"></button>
                                        <button type="button" class="bgx-swatch" data-bg="grad:night" style="background:linear-gradient(135deg,#334155,#0f172a)" title="Night"></button>
                                        <button type="button" class="bgx-swatch" data-bg="grad:mint" style="background:linear-gradient(135deg,#34d399,#0ea5e9)" title="Mint"></button>
                                    </div>
                                </div>

                                <div class="bgx-section-gap">
                                    <span class="bgx-label">Custom</span>
                                    <div class="bgx-color-row">
                                        <span>Pick any color</span>
                                        <input type="color" class="bgx-color-input" id="bgColor" value="#ffffff">
                                    </div>
                                    <button type="button" class="bgx-btn" id="bgImageBtn">
                                        <i class="fas fa-image"></i> Use an image as background
                                    </button>
                                    <input type="file" id="bgImageInput" accept="image/png,image/jpeg,image/webp,image/gif" hidden>
                                </div>
                            </div>

                            <!-- EFFECTS -->
                            <div class="bgx-panel-view" id="panel-effects">
                                <div class="bgx-panel-head">
                                    <h3>Effects</h3>
                                    <p>Add depth or a clean border around your subject.</p>
                                </div>

                                <div class="bgx-card" id="shadowCard">
                                    <div class="bgx-card-head">
                                        <div class="bgx-card-ico"><i class="fas fa-clone"></i></div>
                                        <div>
                                            <b>Drop shadow</b>
                                            <small>Soft shadow behind the subject</small>
                                        </div>
                                        <label class="bgx-switch">
                                            <input type="checkbox" id="shadowToggle">
                                            <span class="bgx-knob"></span>
                                        </label>
                                    </div>
                                    <div class="bgx-card-body">
                                        <div class="bgx-row">
                                            <div class="bgx-row-head"><label for="shadowBlur">Blur</label><output id="shadowBlurVal">40</output></div>
                                            <input type="range" class="bgx-range" id="shadowBlur" min="0" max="100" value="40">
                                        </div>
                                        <div class="bgx-row">
                                            <div class="bgx-row-head"><label for="shadowOpacity">Opacity</label><output id="shadowOpacityVal">45</output></div>
                                            <input type="range" class="bgx-range" id="shadowOpacity" min="0" max="100" value="45">
                                        </div>
                                    </div>
                                </div>

                                <div class="bgx-card" id="outlineCard">
                                    <div class="bgx-card-head">
                                        <div class="bgx-card-ico"><i class="fas fa-border-all"></i></div>
                                        <div>
                                            <b>Outline</b>
                                            <small>Clean border around the subject</small>
                                        </div>
                                        <label class="bgx-switch">
                                            <input type="checkbox" id="outlineToggle">
                                            <span class="bgx-knob"></span>
                                        </label>
                                    </div>
                                    <div class="bgx-card-body">
                                        <div class="bgx-row">
                                            <div class="bgx-row-head"><label for="outlineWidth">Thickness</label><output id="outlineWidthVal">6</output></div>
                                            <input type="range" class="bgx-range" id="outlineWidth" min="1" max="30" value="6">
                                        </div>
                                        <div class="bgx-row">
                                            <div class="bgx-color-row">
                                                <span>Color</span>
                                                <input type="color" class="bgx-color-input" id="outlineColor" value="#ffffff">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ADJUST -->
                            <div class="bgx-panel-view" id="panel-adjust">
                                <div class="bgx-panel-head">
                                    <h3>Adjust</h3>
                                    <p>Fine-tune how the subject looks.</p>
                                </div>

                                <div class="bgx-row" style="margin-top:0">
                                    <div class="bgx-row-head"><label for="brightness">Brightness</label><output id="brightnessVal">0</output></div>
                                    <input type="range" class="bgx-range" id="brightness" min="-100" max="100" value="0">
                                </div>
                                <div class="bgx-row">
                                    <div class="bgx-row-head"><label for="contrast">Contrast</label><output id="contrastVal">0</output></div>
                                    <input type="range" class="bgx-range" id="contrast" min="-100" max="100" value="0">
                                </div>
                                <div class="bgx-row">
                                    <div class="bgx-row-head"><label for="saturation">Saturation</label><output id="saturationVal">0</output></div>
                                    <input type="range" class="bgx-range" id="saturation" min="-100" max="100" value="0">
                                </div>

                                <div class="bgx-divider"></div>
                                <button type="button" class="bgx-btn" id="resetAdjust">
                                    <i class="fas fa-rotate-left"></i> Reset adjustments
                                </button>
                            </div>

                            <!-- TRANSFORM -->
                            <div class="bgx-panel-view" id="panel-transform">
                                <div class="bgx-panel-head">
                                    <h3>Transform</h3>
                                    <p>Flip the subject or change how you view the image.</p>
                                </div>

                                <button type="button" class="bgx-btn" id="flipBtn" style="margin-top:0">
                                    <i class="fas fa-arrows-left-right"></i> Flip horizontal
                                </button>
                                <button type="button" class="bgx-btn" id="fitBtn">
                                    <i class="fas fa-up-right-and-down-left-from-center"></i> Fit to screen
                                </button>
                            </div>

                        </aside>

                        <!-- Stage -->
                        <div class="bgx-stage-col">
                            <div class="bgx-stage-bar">
                                <div class="bgx-status"><span class="bgx-dot"></span><span id="stageStatus">Erase mode</span></div>
                                <div class="bgx-zoom">
                                    <button type="button" id="zoomOut" title="Zoom out"><i class="fas fa-minus"></i></button>
                                    <span id="zoomLabel">100%</span>
                                    <button type="button" id="zoomIn" title="Zoom in"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="bgx-stage" id="stage">
                                <canvas class="bgx-canvas" id="editCanvas"></canvas>
                            </div>

                            <div class="bgx-foot">
                                <div class="bgx-foot-tip"><i class="fas fa-circle-info"></i> Hold Ctrl and scroll to zoom. Use [ and ] to change brush size.</div>
                                <button type="button" class="bgx-new-btn" id="newImageBtn">
                                    <i class="fas fa-plus"></i> New image
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <section class="background-remover-seo-section" aria-labelledby="background-remover-guide-title">
            <div class="seo-content">
                <h2 id="background-remover-guide-title">Free AI Background Remover Online</h2>
                <p>XConvertifire's background remover uses an AI model to identify a prominent subject and separate it from
                    the surrounding image. The result appears as a cutout in the editor, where you can review edges, make
                    brush edits, choose a background and download a PNG. It is designed for removing an image background
                    online without needing desktop image-editing software.</p>
                <p>The removal process runs through this page in your browser. The tool loads its background-removal library
                    and model when needed, then uses them to create an initial result. Automatic separation can be useful
                    for portraits and product photos, but it is not equally accurate for every picture. Review the output
                    before using it in a design or publishing it.</p>

                <h2>How to Remove an Image Background Online</h2>
                <ol>
                    <li>Select an image with the upload control or drop a supported file into the upload area.</li>
                    <li>Allow the page to load the AI assets it needs and process the image. On a first use, model files may
                        need to download.</li>
                    <li>Review the generated cutout in the editor. Check the outline around the subject, especially where
                        the background and subject meet.</li>
                    <li>Use Erase to remove leftover background areas or Restore to paint back parts of the original image.
                        Adjust the brush size for broad or more precise edits.</li>
                    <li>Choose a transparent background, a preset color, a gradient, or a custom color if you want a colored
                        backdrop.</li>
                    <li>Select Download to save the result as a PNG. A transparent selection keeps clear areas transparent;
                        an opaque color or gradient fills those areas.</li>
                </ol>
                <p>For the final composition, you can also compare the original with the cutout, zoom in to inspect details,
                    and use Undo or Redo for brush edits. If the subject needs different framing, use the <a
                        href="{{ route('image.cropper') }}">Image Cropper to adjust the composition</a>. The separate <a
                        href="{{ route('image.resizer') }}">Image Resizer</a> can change dimensions for a project, while
                    the <a href="{{ route('image.compressor') }}">Image Compressor</a> can help manage file size afterward.
                </p>

                <h2>Supported Image Formats and File Size</h2>
                <p>The uploader accepts JPG or JPEG, PNG, WebP and GIF files, with a maximum source file size of 50 MB. The
                    downloaded result is PNG, whether you keep transparency or fill the background with a solid color or
                    gradient. A GIF input does not mean that animation is preserved: the output workflow downloads a PNG
                    image.</p>
                <p>A supported extension alone cannot guarantee that every file will open successfully. An unusual encoding,
                    damaged file or other browser limitation may prevent processing. The page checks the reported file type
                    and size before starting. For more about common image formats, see <a
                        href="https://developer.mozilla.org/en-US/docs/Web/Media/Guides/Formats/Image_types"
                        target="_blank" rel="noopener noreferrer">MDN's guide to image file types</a>. If you need to
                    change a file's format for another workflow, XConvertifire's <a
                        href="{{ route('image.converter') }}">Image Converter</a> provides a separate conversion tool.</p>

                <h2>Transparent PNG Backgrounds</h2>
                <p>Transparency means that some pixels in an image are clear rather than filled with a visible color. PNG
                    supports transparency, so a cutout can sit over different colors, layouts or photographs without
                    retaining a rectangular background. This can be useful for product pictures, profile graphics,
                    presentation slides and other design assets.</p>
                <p>The editor starts with a transparent background option. Selecting white, dark, blue, light, a gradient or
                    a custom color changes the areas behind the cutout; those areas are then included in the PNG rather than
                    remaining transparent. The tool downloads PNG files and does not offer JPEG output. The MDN image format
                    reference linked above also explains how image formats handle transparency.</p>

                <h2>Review and Refine the Cutout</h2>
                <p>Automatic background removal is a starting point, and a quick manual review can catch areas that need
                    attention. The editor provides Erase and Restore brushes with an adjustable size, plus background color
                    and gradient choices. Brightness, contrast and saturation controls can adjust the subject's appearance.
                    Compare, zoom, Undo and Redo help with reviewing and editing the visible cutout.</p>
                <p>Fine hair, fur, transparent objects and edges with little contrast may be difficult to separate cleanly.
                    Busy scenes can also confuse the boundary between subject and background. Try a smaller brush near a
                    detailed edge and inspect the result at a useful zoom level. Avoid assuming that every visible preview
                    control changes the saved file in the same way; the exported result supports the cutout edits,
                    background selection and image adjustments described above, but some decorative or view controls may
                    only affect the editor.</p>

                <h2>Useful Projects for a Background Remover</h2>
                <p>A transparent cutout can make it easier to place a product on a consistent catalog backdrop, position a
                    profile picture in a graphic, or build a social media post with a different color behind the subject. It
                    can also help prepare a presentation visual or a personal design project. Check the result at its
                    intended size and on the background where it will be used; the tool does not certify images for official
                    identification or other regulated requirements.</p>

                <h2>Tips for Better Background Removal Results</h2>
                <ul>
                    <li>Choose an image where the subject is clearly separated from the background.</li>
                    <li>Even lighting and a sharp subject can make the subject's outline easier to identify.</li>
                    <li>Low contrast between the subject and its surroundings can lead to missing or removed edge details.
                    </li>
                    <li>Inspect fine hair, fur, transparent materials and complex backgrounds carefully, then make local
                        Erase or Restore edits where helpful.</li>
                    <li>Review the finished PNG before publishing or using it in a design.</li>
                </ul>

                <h2>Browser Processing and Practical Limits</h2>
                <p>The background-removal workflow uses browser-side AI processing. The page may download the processing
                    library and model assets from its configured CDN, especially on first use. Your browser and device
                    affect how quickly the assets load and the image is processed, so a specific completion time cannot be
                    promised. Large images can also require considerable memory during processing and editing.</p>
                <p>Selected images are handled through this page's browser workflow. This description does not mean the
                    entire website works offline or make broader privacy guarantees. Keep your browser open while the tool
                    works, and try a smaller supported image if the browser runs short of resources. Even with a supported
                    format and size, damaged or unusually encoded files may fail.</p>
                <p>The tool uses the <a href="https://www.npmjs.com/package/@imgly/background-removal" target="_blank"
                        rel="noopener noreferrer">IMG.LY background-removal package</a> for its browser AI workflow. Its
                    model and processing requirements are one reason that a first run can involve downloading assets and
                    that available device resources matter.</p>

                <h2>Background Remover FAQ</h2>
                <div class="seo-faq-list">
                    <details>
                        <summary>Is this background remover free?</summary>
                        <p>The page presents the background-removal tool as free to use. Processing still depends on your
                            browser, device and the required AI assets loading successfully.</p>
                    </details>
                    <details>
                        <summary>How do I remove a background online?</summary>
                        <p>Upload or drop a supported image, wait for browser processing, review the cutout, make optional
                            Erase or Restore edits, choose a background if desired, and download the PNG.</p>
                    </details>
                    <details>
                        <summary>Which image formats can I use?</summary>
                        <p>The input accepts JPG or JPEG, PNG, WebP and GIF. The downloaded image is PNG.</p>
                    </details>
                    <details>
                        <summary>What is the maximum image file size?</summary>
                        <p>The source file limit is 50 MB. Very large images may also require substantial browser memory.
                        </p>
                    </details>
                    <details>
                        <summary>Can I download a transparent PNG?</summary>
                        <p>Yes. Keep the Transparent background option selected to leave the background clear in the PNG.
                        </p>
                    </details>
                    <details>
                        <summary>Can I replace the background with a solid color?</summary>
                        <p>Yes. Choose a preset or custom color, or select the gradient option. The chosen backdrop is
                            included in the PNG.</p>
                    </details>
                    <details>
                        <summary>Can I refine areas the AI missed?</summary>
                        <p>Use the Erase and Restore brushes and adjust the brush size to remove or bring back image areas.
                            Review fine edges manually.</p>
                    </details>
                    <details>
                        <summary>Will a GIF stay animated after background removal?</summary>
                        <p>No. Although GIF is accepted as an input format, the download workflow produces a PNG image, not
                            an animated GIF.</p>
                    </details>
                    <details>
                        <summary>Why can hair and fine edges look imperfect?</summary>
                        <p>Fine strands, transparent objects, low contrast and complex scenes can make subject boundaries
                            hard to distinguish. Inspect and refine the cutout where practical.</p>
                    </details>
                    <details>
                        <summary>Does the tool work in a web browser?</summary>
                        <p>Yes. The AI workflow runs through the browser and may download its library and model files before
                            processing.</p>
                    </details>
                    <details>
                        <summary>Can I remove backgrounds from multiple images at once?</summary>
                        <p>The current editor processes one selected image at a time. It does not provide automatic batch
                            background removal.</p>
                    </details>
                    <details>
                        <summary>Is the original resolution and image quality guaranteed?</summary>
                        <p>No specific resolution or quality outcome is guaranteed for every input. Results depend on the
                            image, model processing and available browser resources; inspect the downloaded PNG before
                            relying on it.</p>
                    </details>
                </div>

                <div class="seo-cta">
                    <h2>Ready to remove an image background?</h2>
                    <p>Start with a supported image and review the cutout in the editor.</p>
                    <a class="seo-cta-link" href="#uploadShell">Upload an image</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Brush cursor (follows the pointer, always centered on it) -->
    <div class="bgx-cursor" id="brushCursor"></div>

    <div class="processing-overlay" id="processingOverlay">
        <div class="processing-card">
            <div class="ai-loader"><span></span><i class="fas fa-wand-magic-sparkles"></i></div>
            <span class="processing-label">AI BACKGROUND REMOVAL</span>
            <h3 id="processingTitle">Analyzing your image</h3>
            <p id="processingText">Loading AI model and preparing the image...</p>
            <div class="progress-track">
                <div class="progress-bar" id="progressBar"></div>
            </div>
            <div class="progress-meta"><strong id="progressPercent">0%</strong><span>Processing locally</span></div>
        </div>
    </div>

    <script type="module">
        /* =========================================================
           X Convertifire BG Remover - Canva-style editor
           ---------------------------------------------------------
           work   = offscreen canvas that holds the real cutout pixels
           canvas = visible canvas, a live render of: background +
                    adjustments + outline + shadow + flip
           The download uses the exact same render function, so what
           you see is what you get.
        ========================================================== */
        const $ = s => document.querySelector(s);
        const $$ = s => document.querySelectorAll(s);

        const input = $('#imageInput');
        const uploadShell = $('#uploadShell');
        const editorSection = $('#editorSection');
        const uploadBox = $('#uploadBox');
        const editor = $('#designEditor');
        const stage = $('#stage');
        const canvas = $('#editCanvas');
        const cursor = $('#brushCursor');
        const overlay = $('#processingOverlay');
        const progress = $('#progressBar');
        const percent = $('#progressPercent');
        const ptext = $('#processingText');
        const ptitle = $('#processingTitle');

        const work = document.createElement('canvas');
        const wctx = work.getContext('2d');

        const filterSupported = typeof CanvasRenderingContext2D !== 'undefined' &&
            'filter' in CanvasRenderingContext2D.prototype;

        const GRADS = {
            blue: ['#3b82f6', '#8b5cf6'],
            sunset: ['#f59e0b', '#ef4444'],
            ocean: ['#06b6d4', '#2563eb'],
            night: ['#334155', '#0f172a'],
            mint: ['#34d399', '#0ea5e9']
        };

        /* ---------- state ---------- */
        let originalImage = null;
        let originalCanvas = null;
        let resultImage = null;
        let resultURL = null;
        let baseName = 'image';
        let history = [];
        let future = [];
        let maxHistory = 25;

        let tool = 'erase';
        let brushSize = 40;
        let drawing = false;
        let lastPt = null;
        let zoom = 1;
        let curPad = 0;
        let flipped = false;
        let showOriginal = false;
        let compareHold = false;

        let bg = 'transparent';
        let bgImg = null;
        let brightness = 0,
            contrast = 0,
            saturation = 0;
        let shadowOn = false,
            shadowBlur = 40,
            shadowOpacity = 45;
        let outlineOn = false,
            outlineWidth = 6,
            outlineColor = '#ffffff';

        const clamp = (v, a, b) => Math.min(b, Math.max(a, v));

        const loadImage = src => new Promise((resolve, reject) => {
            const i = new Image();
            i.onload = () => resolve(i);
            i.onerror = reject;
            i.src = src;
        });

        function prog(v, msg, title = 'Removing background') {
            progress.style.width = v + '%';
            percent.textContent = Math.round(v) + '%';
            ptext.textContent = msg;
            ptitle.textContent = title;
        }

        /* ---------- AI library (lazy load + retries) ---------- */
        const LIB_URL = 'https://cdn.jsdelivr.net/npm/@imgly/background-removal@1.7.0/+esm';
        let cachedRemoveBackground = null;

        async function loadRemovalLib() {
            if (cachedRemoveBackground) return cachedRemoveBackground;
            const mod = await import(LIB_URL);
            if (!mod || typeof mod.removeBackground !== 'function') {
                throw new Error('Library loaded but removeBackground() was not found.');
            }
            cachedRemoveBackground = mod.removeBackground;
            return cachedRemoveBackground;
        }

        async function removeWithAI(file) {
            const removeBackground = await loadRemovalLib();
            const attempts = [{
                    model: 'medium',
                    proxyToWorker: true
                },
                {
                    model: 'medium',
                    proxyToWorker: false
                },
                {
                    model: 'small',
                    proxyToWorker: false
                }
            ];
            let lastErr;
            for (const attempt of attempts) {
                try {
                    return await removeBackground(file, {
                        model: attempt.model,
                        proxyToWorker: attempt.proxyToWorker,
                        output: {
                            format: 'image/png',
                            quality: 1
                        },
                        debug: false,
                        progress: (key, current, total) => {
                            if (total) {
                                const v = 8 + (current / total) * 86;
                                let msg = 'Loading AI segmentation model...';
                                if (key.includes('fetch')) msg = 'Downloading AI model files...';
                                else if (key.includes('compute')) msg = 'Detecting subject and fine edges...';
                                else if (key.includes('mask')) msg = 'Refining the transparency mask...';
                                prog(v, msg);
                            }
                        }
                    });
                } catch (err) {
                    lastErr = err;
                    console.warn('[BG Remover] attempt failed:', attempt, err);
                }
            }
            throw lastErr || new Error('All AI removal attempts failed.');
        }

        /* =========================================================
           RENDER ENGINE (preview + export share this code)
        ========================================================== */
        const tmp = [];

        function layer(i, W, H) {
            let c = tmp[i];
            if (!c) c = tmp[i] = document.createElement('canvas');
            if (c.width !== W || c.height !== H) {
                c.width = W;
                c.height = H;
            } else {
                c.getContext('2d').clearRect(0, 0, W, H);
            }
            return c;
        }

        function metrics() {
            const mx = Math.max(work.width, work.height);
            const outlinePx = outlineOn ? Math.max(1, Math.round(mx * outlineWidth / 1000)) : 0;
            const blur = shadowOn ? Math.round(mx * (0.004 + 0.04 * shadowBlur / 100)) : 0;
            const offY = Math.round(blur * 0.6);
            let pad = 0;
            if (outlineOn) pad = Math.max(pad, outlinePx + 2);
            if (shadowOn) pad = Math.max(pad, blur * 2 + offY + 2);
            return {
                pad,
                outlinePx,
                blur,
                offY
            };
        }

        function filterString() {
            if (!brightness && !contrast && !saturation) return 'none';
            return `brightness(${100 + brightness}%) contrast(${100 + contrast}%) saturate(${100 + saturation}%)`;
        }

        function put(c, img, x, y, W) {
            if (flipped) {
                c.save();
                c.translate(W, 0);
                c.scale(-1, 1);
                c.drawImage(img, x, y);
                c.restore();
            } else {
                c.drawImage(img, x, y);
            }
        }

        function paintBackground(o, W, H) {
            if (bg === 'transparent') return;
            if (bg.startsWith('grad:')) {
                const stops = GRADS[bg.slice(5)] || GRADS.blue;
                const g = o.createLinearGradient(0, 0, W, H);
                g.addColorStop(0, stops[0]);
                g.addColorStop(1, stops[1]);
                o.fillStyle = g;
                o.fillRect(0, 0, W, H);
            } else if (bg === 'image' && bgImg) {
                const r = Math.max(W / bgImg.naturalWidth, H / bgImg.naturalHeight);
                const dw = bgImg.naturalWidth * r;
                const dh = bgImg.naturalHeight * r;
                o.drawImage(bgImg, (W - dw) / 2, (H - dh) / 2, dw, dh);
            } else {
                o.fillStyle = bg;
                o.fillRect(0, 0, W, H);
            }
        }

        function compose(out, preview) {
            const w = work.width,
                h = work.height;
            const m = metrics();
            curPad = m.pad;
            const W = w + 2 * m.pad,
                H = h + 2 * m.pad;
            if (out.width !== W || out.height !== H) {
                out.width = W;
                out.height = H;
            }
            const o = out.getContext('2d');
            o.clearRect(0, 0, W, H);

            // press-and-hold "Original" button
            if (preview && compareHold) {
                put(o, originalCanvas, m.pad, m.pad, W);
                return;
            }

            paintBackground(o, W, H);

            // faded original so removed areas can be restored precisely
            if (preview && showOriginal) {
                o.save();
                o.globalAlpha = 0.38;
                put(o, originalCanvas, m.pad, m.pad, W);
                o.restore();
            }

            // subject layer (with adjustments)
            const sub = layer(0, W, H);
            const sc = sub.getContext('2d');
            if (filterSupported) sc.filter = filterString();
            put(sc, work, m.pad, m.pad, W);
            if (filterSupported) sc.filter = 'none';

            // outline layer
            let base = sub;
            if (outlineOn && m.outlinePx > 0) {
                const sil = layer(1, W, H);
                const silc = sil.getContext('2d');
                silc.drawImage(sub, 0, 0);
                silc.globalCompositeOperation = 'source-in';
                silc.fillStyle = outlineColor;
                silc.fillRect(0, 0, W, H);
                silc.globalCompositeOperation = 'source-over';

                const ol = layer(2, W, H);
                const oc = ol.getContext('2d');
                const r = m.outlinePx;
                const steps = clamp(Math.ceil(2 * Math.PI * r), 16, 72);
                for (let i = 0; i < steps; i++) {
                    const a = (i / steps) * Math.PI * 2;
                    oc.drawImage(sil, Math.cos(a) * r, Math.sin(a) * r);
                }
                oc.drawImage(sil, 0, 0);
                oc.drawImage(sub, 0, 0);
                base = ol;
            }

            // shadow + final draw
            if (shadowOn && m.blur > 0) {
                o.save();
                o.shadowColor = `rgba(0,0,0,${(shadowOpacity / 100).toFixed(2)})`;
                o.shadowBlur = m.blur;
                o.shadowOffsetY = m.offY;
                o.drawImage(base, 0, 0);
                o.restore();
            } else {
                o.drawImage(base, 0, 0);
            }
        }

        function view() {
            if (!work.width) return;
            const W = work.width + 2 * curPad;
            const H = work.height + 2 * curPad;
            const aw = Math.max(120, stage.clientWidth - 56);
            const ah = Math.max(120, stage.clientHeight - 56);
            const fit = Math.min(aw / work.width, ah / work.height, 1);
            const s = fit * zoom;
            canvas.style.width = (W * s) + 'px';
            canvas.style.height = (H * s) + 'px';
            $('#zoomLabel').textContent = Math.round(s * 100) + '%';
            updateCursorSize();
        }

        function render() {
            if (!work.width) return;
            compose(canvas, true);
            view();
        }

        let raf = 0;

        function requestRender() {
            if (raf) return;
            raf = requestAnimationFrame(() => {
                raf = 0;
                render();
            });
        }

        /* ---------- history ---------- */
        function snapshot() {
            if (!work.width) return;
            history.push(wctx.getImageData(0, 0, work.width, work.height));
            while (history.length > maxHistory) history.shift();
            future = [];
            updateHistoryButtons();
        }

        function updateHistoryButtons() {
            $('#undoBtn').disabled = history.length <= 1;
            $('#redoBtn').disabled = future.length === 0;
        }

        function undo() {
            if (history.length > 1) {
                future.push(history.pop());
                wctx.putImageData(history[history.length - 1], 0, 0);
                updateHistoryButtons();
                requestRender();
            }
        }

        function redo() {
            if (future.length) {
                const d = future.pop();
                history.push(d);
                wctx.putImageData(d, 0, 0);
                updateHistoryButtons();
                requestRender();
            }
        }

        /* =========================================================
           UI state helpers
        ========================================================== */
        function setFill(el) {
            const min = +el.min || 0,
                max = +el.max || 100;
            el.style.setProperty('--p', ((el.value - min) / (max - min) * 100) + '%');
        }

        function setStatus(t) {
            $('#stageStatus').textContent = t;
        }

        function setTool(t) {
            tool = t;
            $$('.bgx-brush-card').forEach(c => c.classList.toggle('active', c.dataset.tool === t));
            cursor.classList.toggle('restore', t === 'restore');
            setStatus(t === 'erase' ? 'Erase mode - paint over unwanted areas' :
                'Restore mode - paint over areas to bring them back');
        }

        function updateCursorSize() {
            cursor.style.width = brushSize + 'px';
            cursor.style.height = brushSize + 'px';
        }

        function setBrush(v) {
            brushSize = clamp(Math.round(+v) || 40, 5, 200);
            $('#brushSize').value = brushSize;
            $('#brushNum').value = brushSize;
            setFill($('#brushSize'));
            updateCursorSize();
        }

        function setZoom(z) {
            zoom = clamp(z, 0.25, 8);
            view();
        }

        function resetState() {
            zoom = 1;
            flipped = false;
            showOriginal = false;
            compareHold = false;
            bg = 'transparent';
            bgImg = null;
            brightness = contrast = saturation = 0;
            shadowOn = false;
            outlineOn = false;
            shadowBlur = 40;
            shadowOpacity = 45;
            outlineWidth = 6;
            outlineColor = '#ffffff';

            setTool('erase');
            $('#showOriginal').checked = false;
            $('#flipBtn').classList.remove('active');
            $$('.bgx-swatch').forEach(x => x.classList.toggle('active', x.dataset.bg === 'transparent'));
            $('#bgColor').value = '#ffffff';
            ['brightness', 'contrast', 'saturation'].forEach(id => {
                $('#' + id).value = 0;
                $('#' + id + 'Val').textContent = '0';
            });
            $('#shadowToggle').checked = false;
            $('#shadowCard').classList.remove('on');
            $('#shadowBlur').value = 40;
            $('#shadowBlurVal').textContent = '40';
            $('#shadowOpacity').value = 45;
            $('#shadowOpacityVal').textContent = '45';
            $('#outlineToggle').checked = false;
            $('#outlineCard').classList.remove('on');
            $('#outlineWidth').value = 6;
            $('#outlineWidthVal').textContent = '6';
            $('#outlineColor').value = '#ffffff';
            $$('.bgx-range').forEach(setFill);
        }

        /* =========================================================
           PROCESS A FILE
        ========================================================== */
        async function handleFile(file) {
            const allowedTypes = ['image/png', 'image/jpeg', 'image/webp', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please upload a PNG, JPG, WEBP or GIF image.');
                return;
            }
            if (file.size > 50 * 1024 * 1024) {
                alert('Maximum file size is 50MB.');
                return;
            }

            overlay.classList.add('show');
            prog(3, 'Preparing your image...', 'Preparing image');

            const srcURL = URL.createObjectURL(file);
            try {
                const img = await loadImage(srcURL);
                prog(8, 'Loading AI model (first time 10-20s)...', 'AI background removal');

                const blob = await removeWithAI(file);
                prog(96, 'Refining transparent edges...', 'Finalizing cutout');

                if (resultURL) URL.revokeObjectURL(resultURL);
                resultURL = URL.createObjectURL(blob);
                resultImage = await loadImage(resultURL);

                originalImage = img;
                work.width = resultImage.naturalWidth;
                work.height = resultImage.naturalHeight;
                wctx.clearRect(0, 0, work.width, work.height);
                wctx.drawImage(resultImage, 0, 0);

                originalCanvas = document.createElement('canvas');
                originalCanvas.width = work.width;
                originalCanvas.height = work.height;
                originalCanvas.getContext('2d').drawImage(originalImage, 0, 0, work.width, work.height);

                maxHistory = clamp(Math.floor(220e6 / (work.width * work.height * 4)), 5, 30);
                history = [];
                future = [];
                snapshot();

                baseName = file.name.replace(/\.[^.]+$/, '') || 'image';
                $('#fileName').textContent = file.name;
                $('#fileInfo').textContent = work.width + ' × ' + work.height + ' px • AI cutout';
                $$('.bgx-thumb-img').forEach(i => i.src = resultURL);

                resetState();

                uploadShell.style.display = 'none';
                editorSection.style.display = 'block';
                render();
                updateHistoryButtons();
                setTimeout(() => {
                    render();
                    editorSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 120);

                prog(100, 'Your transparent cutout is ready.', 'Background removed');
                setTimeout(() => overlay.classList.remove('show'), 450);
            } catch (e) {
                console.error('[BG Remover] Processing failed:', e);
                prog(100, 'Could not process this image. Please try again. (' + (e && e.message ? e.message :
                    'Unknown error') + ')', 'Processing failed');
                setTimeout(() => overlay.classList.remove('show'), 3500);
            } finally {
                URL.revokeObjectURL(srcURL);
            }
        }

        /* ---------- file inputs ---------- */
        input.addEventListener('change', e => {
            const f = e.target.files[0];
            if (f) handleFile(f);
            e.target.value = '';
        });
        $('#newImageBtn').addEventListener('click', () => input.click());

        /* ---------- drag & drop ---------- */
        uploadBox.addEventListener('dragover', e => {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.add('drag-active');
        });
        uploadBox.addEventListener('dragleave', e => {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-active');
        });
        uploadBox.addEventListener('drop', e => {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-active');
            const f = e.dataTransfer.files[0];
            if (f && f.type.startsWith('image/')) handleFile(f);
        });
        editor.addEventListener('dragover', e => {
            e.preventDefault();
            editor.classList.add('drag-active');
        });
        editor.addEventListener('dragleave', () => editor.classList.remove('drag-active'));
        editor.addEventListener('drop', e => {
            e.preventDefault();
            editor.classList.remove('drag-active');
            const f = e.dataTransfer.files[0];
            if (f && f.type.startsWith('image/')) handleFile(f);
        });

        /* ---------- rail / panels ---------- */
        $$('.bgx-rail-btn').forEach(btn => btn.addEventListener('click', () => {
            $$('.bgx-rail-btn').forEach(x => x.classList.remove('active'));
            btn.classList.add('active');
            $$('.bgx-panel-view').forEach(x => x.classList.remove('active'));
            $('#panel-' + btn.dataset.panel).classList.add('active');
        }));

        /* =========================================================
           BRUSH
        ========================================================== */
        $$('.bgx-brush-card').forEach(c => c.addEventListener('click', () => setTool(c.dataset.tool)));
        $('#brushSize').addEventListener('input', e => setBrush(e.target.value));
        $('#brushNum').addEventListener('input', e => {
            if (e.target.value === '') return;
            setBrush(e.target.value);
        });
        $('#brushNum').addEventListener('change', e => setBrush(e.target.value));

        function toWork(e) {
            const r = canvas.getBoundingClientRect();
            const k = canvas.width / r.width;
            let px = (e.clientX - r.left) * k;
            const py = (e.clientY - r.top) * k;
            if (flipped) px = canvas.width - px;
            return {
                x: px - curPad,
                y: py - curPad,
                k
            };
        }

        function dab(x, y, rad) {
            if (tool === 'erase') {
                wctx.save();
                wctx.globalCompositeOperation = 'destination-out';
                wctx.beginPath();
                wctx.arc(x, y, rad, 0, Math.PI * 2);
                wctx.fill();
                wctx.restore();
            } else {
                const x0 = Math.max(0, Math.floor(x - rad));
                const y0 = Math.max(0, Math.floor(y - rad));
                const x1 = Math.min(work.width, Math.ceil(x + rad));
                const y1 = Math.min(work.height, Math.ceil(y + rad));
                if (x1 <= x0 || y1 <= y0) return;
                wctx.save();
                wctx.beginPath();
                wctx.arc(x, y, rad, 0, Math.PI * 2);
                wctx.clip();
                wctx.drawImage(originalCanvas, x0, y0, x1 - x0, y1 - y0, x0, y0, x1 - x0, y1 - y0);
                wctx.restore();
            }
        }

        function strokeTo(pt) {
            const rad = (brushSize / 2) * pt.k;
            if (!lastPt) {
                dab(pt.x, pt.y, rad);
            } else {
                const dist = Math.hypot(pt.x - lastPt.x, pt.y - lastPt.y);
                const step = Math.max(1, rad * 0.25);
                const n = Math.max(1, Math.ceil(dist / step));
                for (let i = 1; i <= n; i++) {
                    dab(lastPt.x + (pt.x - lastPt.x) * i / n, lastPt.y + (pt.y - lastPt.y) * i / n, rad);
                }
            }
            lastPt = pt;
            requestRender();
        }

        function moveCursor(e) {
            if (e.pointerType === 'touch') {
                cursor.style.display = 'none';
                return;
            }
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            cursor.style.display = 'block';
        }

        canvas.addEventListener('pointerenter', moveCursor);
        canvas.addEventListener('pointermove', e => {
            moveCursor(e);
            if (drawing) strokeTo(toWork(e));
        });
        canvas.addEventListener('pointerleave', () => {
            if (!drawing) cursor.style.display = 'none';
        });
        canvas.addEventListener('pointerdown', e => {
            if (!work.width || e.button > 0) return;
            e.preventDefault();
            drawing = true;
            lastPt = null;
            canvas.setPointerCapture(e.pointerId);
            moveCursor(e);
            strokeTo(toWork(e));
        });

        function endStroke(e) {
            if (!drawing) return;
            drawing = false;
            lastPt = null;
            snapshot();
            if (e && e.type === 'pointerup' && e.target !== canvas) cursor.style.display = 'none';
        }
        canvas.addEventListener('pointerup', endStroke);
        canvas.addEventListener('pointercancel', endStroke);

        $('#resetCutout').addEventListener('click', () => {
            if (!resultImage) return;
            wctx.clearRect(0, 0, work.width, work.height);
            wctx.drawImage(resultImage, 0, 0);
            snapshot();
            requestRender();
            setStatus('Cutout reset to the AI result');
        });

        $('#showOriginal').addEventListener('change', e => {
            showOriginal = e.target.checked;
            requestRender();
        });

        /* ---------- undo / redo / compare ---------- */
        $('#undoBtn').addEventListener('click', undo);
        $('#redoBtn').addEventListener('click', redo);

        const cmp = $('#compareBtn');

        function holdCompare(on) {
            if (compareHold === on) return;
            compareHold = on;
            requestRender();
        }
        cmp.addEventListener('pointerdown', e => {
            e.preventDefault();
            holdCompare(true);
        });
        ['pointerup', 'pointerleave', 'pointercancel'].forEach(ev => cmp.addEventListener(ev, () => holdCompare(false)));

        /* ---------- keyboard ---------- */
        document.addEventListener('keydown', e => {
            if (editorSection.style.display === 'none') return;
            const tag = (e.target.tagName || '').toLowerCase();
            if (tag === 'input' && e.target.type !== 'range' && e.target.type !== 'checkbox') return;
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'z') {
                e.preventDefault();
                e.shiftKey ? redo() : undo();
            } else if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'y') {
                e.preventDefault();
                redo();
            } else if (e.key === '[') {
                setBrush(brushSize - 5);
            } else if (e.key === ']') {
                setBrush(brushSize + 5);
            }
        });

        /* ---------- zoom ---------- */
        $('#zoomIn').addEventListener('click', () => setZoom(zoom * 1.2));
        $('#zoomOut').addEventListener('click', () => setZoom(zoom / 1.2));
        stage.addEventListener('wheel', e => {
            if (!e.ctrlKey) return;
            e.preventDefault();
            setZoom(zoom * (e.deltaY < 0 ? 1.1 : 0.9));
        }, {
            passive: false
        });
        $('#fitBtn').addEventListener('click', () => {
            zoom = 1;
            stage.scrollLeft = 0;
            stage.scrollTop = 0;
            view();
        });
        $('#flipBtn').addEventListener('click', e => {
            flipped = !flipped;
            e.currentTarget.classList.toggle('active', flipped);
            requestRender();
        });
        window.addEventListener('resize', view);

        /* =========================================================
           BACKGROUND (live preview)
        ========================================================== */
        function clearSwatches() {
            $$('.bgx-swatch').forEach(x => x.classList.remove('active'));
        }
        $$('.bgx-swatch').forEach(b => b.addEventListener('click', () => {
            clearSwatches();
            b.classList.add('active');
            bg = b.dataset.bg;
            bgImg = null;
            if (/^#/.test(bg)) $('#bgColor').value = bg.length === 7 ? bg : '#ffffff';
            requestRender();
        }));
        $('#bgColor').addEventListener('input', e => {
            clearSwatches();
            bg = e.target.value;
            bgImg = null;
            requestRender();
        });
        $('#bgImageBtn').addEventListener('click', () => $('#bgImageInput').click());
        $('#bgImageInput').addEventListener('change', async e => {
            const f = e.target.files[0];
            e.target.value = '';
            if (!f || !f.type.startsWith('image/')) return;
            const url = URL.createObjectURL(f);
            try {
                bgImg = await loadImage(url);
                bg = 'image';
                clearSwatches();
                requestRender();
            } catch (err) {
                alert('Unable to read that background image.');
            }
        });

        /* =========================================================
           EFFECTS + ADJUST (live preview)
        ========================================================== */
        function bind(id, fn, outId) {
            const el = $('#' + id);
            el.addEventListener('input', () => {
                if (outId) $('#' + outId).textContent = el.value;
                fn(+el.value);
                requestRender();
            });
        }
        bind('shadowBlur', v => shadowBlur = v, 'shadowBlurVal');
        bind('shadowOpacity', v => shadowOpacity = v, 'shadowOpacityVal');
        bind('outlineWidth', v => outlineWidth = v, 'outlineWidthVal');
        bind('brightness', v => brightness = v, 'brightnessVal');
        bind('contrast', v => contrast = v, 'contrastVal');
        bind('saturation', v => saturation = v, 'saturationVal');

        $('#shadowToggle').addEventListener('change', e => {
            shadowOn = e.target.checked;
            $('#shadowCard').classList.toggle('on', shadowOn);
            requestRender();
        });
        $('#outlineToggle').addEventListener('change', e => {
            outlineOn = e.target.checked;
            $('#outlineCard').classList.toggle('on', outlineOn);
            requestRender();
        });
        $('#outlineColor').addEventListener('input', e => {
            outlineColor = e.target.value;
            requestRender();
        });
        $('#resetAdjust').addEventListener('click', () => {
            brightness = contrast = saturation = 0;
            ['brightness', 'contrast', 'saturation'].forEach(id => {
                $('#' + id).value = 0;
                $('#' + id + 'Val').textContent = '0';
                setFill($('#' + id));
            });
            requestRender();
        });

        document.addEventListener('input', e => {
            if (e.target.classList && e.target.classList.contains('bgx-range')) setFill(e.target);
        });
        $$('.bgx-range').forEach(setFill);
        updateCursorSize();

        /* =========================================================
           DOWNLOAD (same render as the preview)
        ========================================================== */
        $('#downloadTop').addEventListener('click', () => {
            if (!work.width) return;
            const out = document.createElement('canvas');
            compose(out, false);
            render();
            out.toBlob(b => {
                if (!b) {
                    alert('Unable to create the image. Try a smaller image.');
                    return;
                }
                const a = document.createElement('a');
                a.href = URL.createObjectURL(b);
                a.download = baseName + '-no-background.png';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(() => URL.revokeObjectURL(a.href), 1000);
            }, 'image/png');
        });

        const navbar = $('#morphNavbar');
        window.addEventListener('scroll', () => navbar && navbar.classList.toggle('scrolled', scrollY > 50));
    </script>
@endsection

