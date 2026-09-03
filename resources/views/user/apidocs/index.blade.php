<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentasi API | Antrian</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/'.$logo) }}?v={{ $logo_version }}">
    <style>
        :root { --primary:#2563eb; --primary-dark:#1d4ed8; --primary-soft:#eff6ff; --primary-border:#bfdbfe; --ink:#101828; --muted:#667085; --line:#e4e7ec; --panel:#fff; --code:#101828; --page:#f8fafc; }
        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { margin:0; color:var(--ink); background:var(--page); font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif; font-size:14px; line-height:1.65; }
        a { color:inherit; text-decoration:none; }
        .topbar { position:sticky; top:0; z-index:20; height:64px; padding:0 28px; display:flex; align-items:center; justify-content:space-between; background:#fff; border-bottom:1px solid var(--line); }
        .brand { display:flex; align-items:center; gap:12px; font-weight:700; }
        .brand-mark { width:32px; height:32px; display:grid; place-items:center; border-radius:9px; color:#fff; background:var(--primary); }
        .crumb { color:#98a2b3; font-weight:400; }
        .dashboard-link { padding:8px 15px; color:#fff; background:var(--primary); border-radius:9px; font-size:12px; font-weight:700; }
        .page { max-width:1540px; margin:0 auto; display:grid; grid-template-columns:220px minmax(0, 1fr) 210px; gap:34px; padding:30px 28px 80px; }
        .sidebar, .toc { position:sticky; top:94px; align-self:start; }
        .nav-title { margin:0 0 9px; color:#98a2b3; font-size:10px; font-weight:800; letter-spacing:.09em; text-transform:uppercase; }
        .nav-group { margin-bottom:24px; }
        .nav-link { display:block; padding:7px 10px; margin:2px 0; color:#475467; border-radius:7px; font-size:12px; }
        .nav-link:hover, .nav-link.active { color:var(--primary-dark); background:var(--primary-soft); }
        .main { min-width:0; max-width:940px; }
        .hero { margin-bottom:34px; }
        .eyebrow { margin:0 0 8px; color:var(--primary); font-size:12px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; }
        h1 { margin:0 0 10px; font-size:30px; line-height:1.25; }
        h2 { margin:0 0 12px; font-size:22px; }
        h3 { margin:0 0 9px; font-size:16px; }
        p { margin:0 0 13px; color:#475467; }
        .version-card { display:flex; align-items:center; justify-content:space-between; gap:24px; margin-top:22px; padding:18px 20px; background:#fff; border:1px solid #d0d5dd; border-radius:12px; box-shadow:0 3px 12px rgba(16,24,40,.04); }
        .version-label { color:#98a2b3; font-size:10px; font-weight:800; letter-spacing:.08em; text-transform:uppercase; }
        .version-value { margin-top:2px; font-size:18px; font-weight:750; }
        .updated { color:var(--primary-dark); background:var(--primary-soft); border-radius:999px; padding:6px 11px; font-size:12px; white-space:nowrap; }
        .doc-section { padding:34px 0; border-top:1px solid var(--line); scroll-margin-top:84px; }
        .doc-section.first { padding-top:0; border-top:0; }
        .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:18px; }
        .info-card { padding:16px; background:#fff; border:1px solid var(--line); border-radius:10px; }
        .info-card strong { display:block; margin-bottom:5px; }
        .code-wrap { position:relative; margin:12px 0 16px; }
        pre { margin:0; padding:17px 18px; overflow:auto; color:#e6edf7; background:var(--code); border-radius:10px; font:12px/1.7 Consolas,"Courier New",monospace; white-space:pre-wrap; word-break:break-word; }
        code.inline { padding:2px 5px; color:#344054; background:#eef2f6; border-radius:4px; font-family:Consolas,"Courier New",monospace; font-size:12px; }
        .copy-btn, .key-btn { border:1px solid #d0d5dd; background:#fff; color:#344054; border-radius:7px; padding:7px 10px; cursor:pointer; font-weight:650; }
        .copy-btn { position:absolute; top:9px; right:9px; border-color:#344054; color:#e6edf7; background:#1d2939; font-size:11px; }
        .key-box { display:flex; align-items:center; gap:9px; margin:12px 0 16px; padding:12px; background:#fff; border:1px solid var(--line); border-radius:10px; }
        .key-value { flex:1; min-width:0; overflow:hidden; color:#344054; font-family:Consolas,"Courier New",monospace; white-space:nowrap; text-overflow:ellipsis; }
        .endpoint { padding:28px 0; border-top:1px solid var(--line); scroll-margin-top:84px; }
        .endpoint:first-child { padding-top:0; border-top:0; }
        .endpoint-title { display:flex; align-items:center; gap:10px; margin-bottom:9px; }
        .method { display:inline-block; padding:4px 8px; color:var(--primary-dark); background:var(--primary-soft); border:1px solid var(--primary-border); border-radius:6px; font-size:10px; font-weight:850; }
        .path { color:#344054; font:600 13px Consolas,"Courier New",monospace; }
        table { width:100%; margin:13px 0 18px; border-collapse:separate; border-spacing:0; overflow:hidden; background:#fff; border:1px solid var(--line); border-radius:9px; font-size:12px; }
        th, td { padding:10px 12px; text-align:left; vertical-align:top; border-bottom:1px solid var(--line); }
        tr:last-child td { border-bottom:0; }
        th { color:#475467; background:#f9fafb; font-size:10px; letter-spacing:.04em; text-transform:uppercase; }
        .required { color:#b42318; font-weight:700; }
        .optional { color:#667085; }
        .toc-box { padding:15px; background:#fff; border:1px solid #d0d5dd; border-radius:11px; }
        .toc a { display:block; padding:4px 0; color:#475467; font-size:11px; }
        .toc a:hover { color:var(--primary); }
        .status-list { display:flex; flex-wrap:wrap; gap:8px; margin-top:14px; }
        .status { padding:6px 9px; background:#fff; border:1px solid var(--line); border-radius:7px; font-size:11px; }
        .status b { color:var(--primary); }
        @media (max-width:1050px) { .page { grid-template-columns:190px minmax(0,1fr); } .toc { display:none; } }
        @media (max-width:720px) { .topbar { padding:0 16px; } .crumb { display:none; } .page { display:block; padding:22px 16px 60px; } .sidebar { position:static; display:flex; gap:6px; overflow:auto; margin-bottom:28px; padding-bottom:8px; } .nav-group { display:flex; margin:0; } .nav-title { display:none; } .nav-link { white-space:nowrap; border:1px solid var(--line); } .info-grid { grid-template-columns:1fr; } .version-card { align-items:flex-start; flex-direction:column; gap:10px; } .key-box { align-items:stretch; flex-wrap:wrap; } .key-value { width:100%; flex-basis:100%; } h1 { font-size:25px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">
            <span class="brand-mark">A</span>
            <span>{{ $company_name }}</span>
            <span class="crumb">/</span>
            <span class="crumb">Dokumentasi API</span>
        </div>
        <a class="dashboard-link" href="{{ route('dashboard') }}">Buka Dashboard</a>
    </header>

    <div class="page">
        <nav class="sidebar" aria-label="Navigasi dokumentasi">
            <div class="nav-group">
                <div class="nav-title">Pendahuluan</div>
                <a class="nav-link" href="#ringkasan">Ringkasan</a>
                <a class="nav-link" href="#autentikasi">Autentikasi</a>
                <a class="nav-link" href="#format">Format Balasan</a>
                <a class="nav-link" href="#status">Kode Status</a>
            </div>
            <div class="nav-group">
                <div class="nav-title">Endpoint</div>
                @foreach ($endpoints as $endpoint)
                    <a class="nav-link" href="#{{ $endpoint['id'] }}">{{ $endpoint['name'] }}</a>
                @endforeach
            </div>
            <div class="nav-group">
                <div class="nav-title">Unduhan</div>
                <a class="nav-link" href="{{ asset('API ANTRIAN.postman_collection.json') }}" download="API ANTRIAN.postman_collection.json">Download Collection Postman</a>
            </div>
        </nav>

        <main class="main">
            <section class="hero" id="ringkasan">
                <p class="eyebrow">API Sistem Antrian</p>
                <h1>Dokumentasi API</h1>
                <p>Gunakan API ini untuk membaca data layanan dan loket, mengambil nomor antrean, melihat antrean berikutnya, serta melakukan panggilan dari aplikasi lain.</p>

                <div class="version-card">
                    <div>
                        <div class="version-label">Versi API</div>
                        <div class="version-value">{{ $version }}</div>
                    </div>
                    <span class="updated" id="updatedAgo" data-timestamp="{{ $updatedAtTimestamp }}">Diperbarui {{ $updatedAgo }}</span>
                </div>
            </section>

            <section class="doc-section first">
                <h2>Ringkasan</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <strong>Base URL</strong>
                        <code class="inline">{{ $baseUrl }}</code>
                    </div>
                    <div class="info-card">
                        <strong>Content type</strong>
                        <code class="inline">application/json</code>
                    </div>
                </div>
            </section>

            <section class="doc-section" id="autentikasi">
                <h2>Autentikasi</h2>
                <p>Semua endpoint membutuhkan satu API key. Kirimkan key pada header <code class="inline">x-api-key</code>. API key bersifat rahasia dan tidak boleh diletakkan pada URL.</p>

                <h3>API key aplikasi</h3>
                <div class="key-box">
                    <span class="key-value" id="apiKeyValue">••••••••••••••••••••••••••••••••</span>
                    <button type="button" class="key-btn" id="toggleKey">Tampilkan</button>
                    <button type="button" class="key-btn" id="copyKey">Salin</button>
                </div>

                <h3>Header wajib</h3>
                <div class="code-wrap">
                    <pre id="headerCode">x-api-key: YOUR_API_KEY
Accept: application/json</pre>
                    <button type="button" class="copy-btn" data-copy-target="headerCode">Salin</button>
                </div>
            </section>

            <section class="doc-section" id="format">
                <h2>Format Balasan</h2>
                <p>Balasan menggunakan JSON. Secara umum respons berisi <code class="inline">status</code>, <code class="inline">message</code>, dan <code class="inline">data</code>.</p>
                <div class="code-wrap">
                    <pre id="formatCode">{
  "status": "success",
  "message": "Permintaan berhasil",
  "data": {}
}</pre>
                    <button type="button" class="copy-btn" data-copy-target="formatCode">Salin</button>
                </div>
            </section>

            <section class="doc-section" id="status">
                <h2>Kode Status</h2>
                <div class="status-list">
                    <span class="status"><b>200</b> Berhasil</span>
                    <span class="status"><b>401</b> API key tidak valid</span>
                    <span class="status"><b>404</b> Data tidak ditemukan</span>
                    <span class="status"><b>429</b> Terlalu banyak permintaan</span>
                    <span class="status"><b>500</b> Kesalahan server</span>
                </div>
            </section>

            <section class="doc-section" id="endpoint">
                <h2>Endpoint</h2>
                <p>Parameter dikirim melalui query string. Contoh di bawah menggunakan nilai ID <code class="inline">1</code>.</p>
                <p><strong>Alur pemanggilan:</strong> gunakan <code class="inline">/call</code> untuk memanggil antrean berikutnya. Jika antrean yang sama perlu dipanggil ulang, gunakan <code class="inline">/recall</code>—jangan gunakan <code class="inline">/call</code> lagi karena endpoint tersebut akan mengambil antrean berikutnya.</p>

                @foreach ($endpoints as $endpoint)
                    <article class="endpoint" id="{{ $endpoint['id'] }}">
                        <div class="endpoint-title">
                            <span class="method">{{ $endpoint['method'] }}</span>
                            <h3>{{ $endpoint['name'] }}</h3>
                        </div>
                        <div class="path">{{ $endpoint['path'] }}</div>
                        <p style="margin-top:9px">{{ $endpoint['description'] }}</p>

                        @if (count($endpoint['parameters']))
                            <table>
                                <thead><tr><th>Parameter</th><th>Tipe</th><th>Wajib</th><th>Keterangan</th></tr></thead>
                                <tbody>
                                    @foreach ($endpoint['parameters'] as $parameter)
                                        <tr>
                                            <td><code class="inline">{{ $parameter['name'] }}</code></td>
                                            <td>{{ $parameter['type'] }}</td>
                                            <td class="{{ $parameter['required'] ? 'required' : 'optional' }}">{{ $parameter['required'] ? 'Ya' : 'Tidak' }}</td>
                                            <td>{{ $parameter['description'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p><em>Endpoint ini tidak membutuhkan parameter.</em></p>
                        @endif

                        <h3>Contoh request</h3>
                        <div class="code-wrap">
                            <pre id="request-{{ $endpoint['id'] }}">curl --request {{ $endpoint['method'] }} \
  --url '{{ $endpoint['example_url'] }}' \
  --header 'Accept: application/json' \
  --header 'x-api-key: YOUR_API_KEY'</pre>
                            <button type="button" class="copy-btn" data-copy-target="request-{{ $endpoint['id'] }}">Salin</button>
                        </div>

                        <h3>Contoh respons</h3>
                        <div class="code-wrap">
                            <pre id="response-{{ $endpoint['id'] }}">{{ json_encode($endpoint['response'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
                            <button type="button" class="copy-btn" data-copy-target="response-{{ $endpoint['id'] }}">Salin</button>
                        </div>
                    </article>
                @endforeach
            </section>
        </main>

        <aside class="toc">
            <div class="toc-box">
                <div class="nav-title">Pada halaman ini</div>
                <a href="#ringkasan">1. Ringkasan</a>
                <a href="#autentikasi">2. Autentikasi</a>
                <a href="#format">3. Format Balasan</a>
                <a href="#status">4. Kode Status</a>
                <a href="#endpoint">5. Endpoint</a>
            </div>
        </aside>
    </div>

    <script>
        (function () {
            var apiKey = {!! json_encode($apiKey) !!};
            var keyValue = document.getElementById('apiKeyValue');
            var toggleKey = document.getElementById('toggleKey');
            var keyVisible = false;

            toggleKey.addEventListener('click', function () {
                keyVisible = !keyVisible;
                keyValue.textContent = keyVisible ? apiKey : '••••••••••••••••••••••••••••••••';
                toggleKey.textContent = keyVisible ? 'Sembunyikan' : 'Tampilkan';
            });

            document.getElementById('copyKey').addEventListener('click', function () {
                copyText(apiKey, this);
            });

            Array.prototype.forEach.call(document.querySelectorAll('[data-copy-target]'), function (button) {
                button.addEventListener('click', function () {
                    copyText(document.getElementById(this.getAttribute('data-copy-target')).textContent, this);
                });
            });

            function copyText(text, button) {
                var originalText = button.textContent;
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(function () { showCopied(button, originalText); });
                    return;
                }

                var area = document.createElement('textarea');
                area.value = text;
                area.style.position = 'fixed';
                area.style.opacity = '0';
                document.body.appendChild(area);
                area.select();
                document.execCommand('copy');
                document.body.removeChild(area);
                showCopied(button, originalText);
            }

            function showCopied(button, originalText) {
                button.textContent = 'Tersalin';
                window.setTimeout(function () { button.textContent = originalText; }, 1400);
            }

            function updateRelativeTime() {
                var target = document.getElementById('updatedAgo');
                var updatedAt = parseInt(target.getAttribute('data-timestamp'), 10);
                var elapsed = Math.max(0, Math.floor(Date.now() / 1000) - updatedAt);
                var text;

                if (elapsed < 60) text = 'baru saja';
                else if (elapsed < 3600) text = Math.floor(elapsed / 60) + ' menit lalu';
                else if (elapsed < 86400) text = Math.floor(elapsed / 3600) + ' jam lalu';
                else text = Math.floor(elapsed / 86400) + ' hari lalu';

                target.textContent = 'Diperbarui ' + text;
            }

            updateRelativeTime();
            window.setInterval(updateRelativeTime, 60000);

            var navigationLinks = Array.prototype.slice.call(document.querySelectorAll('.sidebar .nav-link[href^="#"]'));
            var navigationSections = navigationLinks.map(function (link) {
                return {
                    link: link,
                    section: document.getElementById(link.getAttribute('href').substring(1))
                };
            }).filter(function (item) {
                return item.section;
            });
            var scrollTicking = false;

            function updateActiveNavigation() {
                var readingLine = 145;
                var activeItem = navigationSections[0];

                navigationSections.forEach(function (item) {
                    if (item.section.getBoundingClientRect().top <= readingLine) {
                        activeItem = item;
                    }
                });

                if (window.innerHeight + window.pageYOffset >= document.documentElement.scrollHeight - 4) {
                    activeItem = navigationSections[navigationSections.length - 1];
                }

                navigationLinks.forEach(function (link) {
                    link.classList.toggle('active', activeItem && link === activeItem.link);
                });

                scrollTicking = false;
            }

            window.addEventListener('scroll', function () {
                if (!scrollTicking) {
                    window.requestAnimationFrame(updateActiveNavigation);
                    scrollTicking = true;
                }
            });
            window.addEventListener('resize', updateActiveNavigation);
            updateActiveNavigation();
        }());
    </script>
</body>
</html>
