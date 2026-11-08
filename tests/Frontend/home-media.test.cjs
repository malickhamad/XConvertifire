const fs = require('node:fs');
const vm = require('node:vm');
const assert = require('node:assert/strict');
const code = fs.readFileSync('public/assets/js/home.js', 'utf8');

function run({ reduced = false, saveData = false, desktop = true, ready = 'complete' } = {}) {
    const listeners = new Map();
    const idle = [];
    const loaded = [];
    const observed = [];
    const makeVideo = name => {
        const source = { dataset: { src: `${name}.mp4` }, removeAttribute() { delete this.dataset.src; } };
        return {
            querySelector: () => source.dataset.src ? source : null,
            load: () => loaded.push(name), play: () => Promise.resolve(),
        };
    };
    const hero = makeVideo('hero');
    const bento = makeVideo('bento');
    class Observer {
        constructor(callback) { this.callback = callback; observed.push(this); }
        observe() {}
        disconnect() {}
    }
    const window = {
        matchMedia: query => ({ matches: query.includes('reduced-motion') ? reduced : desktop }),
        addEventListener: (name, callback) => listeners.set(name, callback),
        removeEventListener: name => listeners.delete(name),
        requestIdleCallback: callback => idle.push(callback),
        IntersectionObserver: Observer,
    };
    const document = {
        readyState: ready,
        querySelectorAll: () => [],
        querySelector: selector => selector.includes('hero') ? hero : bento,
    };
    vm.runInNewContext(code, { window, document, navigator: { connection: { saveData } }, IntersectionObserver: Observer });
    return { listeners, idle, loaded, observed, document };
}

const desktop = run();
assert.deepEqual(desktop.loaded, []);
assert.equal(desktop.idle.length, 0, 'No decorative media is scheduled on initial load');
desktop.listeners.get('wheel')();
assert.equal(desktop.listeners.has('pointerdown'), false, 'Intent listeners are removed after the first interaction');
assert.equal(desktop.idle.length, 1);
desktop.idle[0]();
assert.deepEqual(desktop.loaded, ['hero']);
desktop.observed[0].callback([{ isIntersecting: true }]);
assert.deepEqual(desktop.loaded, ['hero', 'bento']);

const mobile = run({ desktop: false });
mobile.listeners.get('pointerdown')();
mobile.idle[0]();
assert.deepEqual(mobile.loaded, [], 'Mobile hero video remains unloaded');
mobile.observed[0].callback([{ isIntersecting: true }]);
assert.deepEqual(mobile.loaded, ['bento']);

for (const options of [{ reduced: true }, { saveData: true }]) {
    const disabled = run(options);
    assert.equal(disabled.listeners.size, 0);
    assert.equal(disabled.idle.length, 0);
}

const loading = run({ ready: 'loading' });
loading.listeners.get('keydown')();
assert.equal(loading.idle.length, 0, 'An early interaction still waits for document load');
loading.document.readyState = 'complete';
loading.listeners.get('load')();
assert.equal(loading.idle.length, 1);
console.log('Media behavior checks passed: desktop, mobile, reduced motion, data saver, early interaction.');
