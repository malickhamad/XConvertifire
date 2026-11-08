// Run after editing public/assets/css/style.css. Keep the generated file in Git.
const fs = require('node:fs');
const path = require('node:path');
const { transform } = require('lightningcss');
const postcss = require('postcss');

const root = path.resolve(__dirname, '..');
const source = path.join(root, 'public/assets/css/style.css');
const output = path.join(root, 'public/assets/css/style.min.css');
const result = transform({ filename: source, code: fs.readFileSync(source), minify: true });
fs.writeFileSync(output, result.code);
console.log(`Built ${path.relative(root, output)} (${result.code.length} bytes)`);

// Homepage-only vendor bundles. Other pages retain the complete vendor styles.
const templates = [
    'resources/views/pages/home.blade.php',
    'resources/views/components/navbar.blade.php',
    'resources/views/components/footer.blade.php',
];
const classes = new Set(['fa-bars', 'fa-times', 'show', 'active']);
for (const template of templates) {
    const html = fs.readFileSync(path.join(root, template), 'utf8');
    for (const match of html.matchAll(/class\s*=\s*["']([^"']+)["']/g)) {
        for (const name of match[1].split(/\s+/)) classes.add(name);
    }
}

for (const [inputName, outputName] of [
    ['bootstrap-5.3.2.min.css', 'bootstrap-home.min.css'],
    ['fontawesome-6.4.0.min.css', 'fontawesome-home.min.css'],
]) {
    const input = path.join(root, 'public/assets/vendor', inputName);
    const stylesheet = postcss.parse(fs.readFileSync(input, 'utf8'));
    stylesheet.walkRules(rule => {
        // Keyframe selectors are percentages, not document selectors.
        if (rule.parent.type === 'atrule' && /keyframes$/i.test(rule.parent.name)) return;
        const selectors = rule.selectors.filter(selector => {
            const names = [...selector.matchAll(/\.([a-zA-Z_][\w-]*)/g)].map(match => match[1]);
            return names.every(name => classes.has(name));
        });
        if (selectors.length === 0) rule.remove();
        else rule.selectors = selectors;
    });
    stylesheet.walkAtRules(rule => {
        if (rule.nodes && rule.nodes.length === 0) rule.remove();
    });
    const built = transform({ filename: inputName, code: Buffer.from(stylesheet.toString()), minify: true });
    fs.writeFileSync(path.join(root, 'public/assets/vendor', outputName), built.code);
    console.log(`Built ${outputName} (${built.code.length} bytes)`);
}
