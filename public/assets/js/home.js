(() => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    document.querySelectorAll('.filter-pills .pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.filter-pills .pill').forEach(button => {
                button.classList.toggle('active', button === pill);
            });
            document.getElementById(pill.dataset.target)?.scrollIntoView({
                behavior: reducedMotion.matches ? 'auto' : 'smooth',
                block: 'start',
            });
        });
    });

    // Decorative video must not compete with the initial content download.
    if (reducedMotion.matches || navigator.connection?.saveData) return;

    const playVideo = video => {
        const source = video?.querySelector('source[data-src]');
        if (!source) return;
        video.muted = true;
        source.src = source.dataset.src;
        source.removeAttribute('data-src');
        video.load();
        video.play()?.catch(() => {});
    };

    const startVideos = () => {
        if (window.matchMedia('(min-width: 992px)').matches) {
            playVideo(document.querySelector('.hero-bg-video'));
        }

        const bentoVideo = document.querySelector('.bento-video');
        if (bentoVideo && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver(entries => {
                if (entries.some(entry => entry.isIntersecting)) {
                    playVideo(bentoVideo);
                    observer.disconnect();
                }
            }, { rootMargin: '100px' });
            observer.observe(bentoVideo);
        }
    };

    const scheduleVideos = () => {
        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(startVideos, { timeout: 2500 });
        } else {
            window.setTimeout(startVideos, 1000);
        }
    };

    if (document.readyState === 'complete') {
        scheduleVideos();
    } else {
        window.addEventListener('load', scheduleVideos, { once: true });
    }
})();
