<div class="relative facility-search">
    <form class="search-box" action="{{ route('facility') }}" method="GET">
        <span class="search-icon">&#128269;</span>
        <input
            type="text"
            name="search"
            placeholder="Search Facilities..."
            autocomplete="off"
            @if($searchInputId) id="{{ $searchInputId }}" @endif
        >
    </form>

    <div class="notification-panel facility-search-panel" style="display: none; position: absolute; z-index: 9999;">
        <div class="notification-header">
            <div class="notification-title">Fasilitas Ditemukan</div>
        </div>
        <div class="notification-list facility-search-list" style="max-height: 300px; overflow-y: auto;"></div>
        <div class="notification-header" style="justify-content: center; border-top: 1px solid #eee;">
            <a class="notification-action facility-search-more" href="{{ route('facility') }}">SEE MORE RESULTS</a>
        </div>
    </div>
</div>

<style>
    .facility-search {
        position: relative;
    }
    .facility-search-panel {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 8px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>

<script>
    (function() {
        const wrapper = document.querySelector('.facility-search');
        if (!wrapper) return;

        const input = wrapper.querySelector('input[name="search"]');
        const panel = wrapper.querySelector('.facility-search-panel');
        const list = wrapper.querySelector('.facility-search-list');
        const moreLink = wrapper.querySelector('.facility-search-more');

        if (!input || !panel || !list || !moreLink) return;

        let debounceTimer = null;

        function alignPanelToInput() {
            const wrapperRect = wrapper.getBoundingClientRect();
            const inputRect = input.getBoundingClientRect();
            panel.style.left = `${inputRect.left - wrapperRect.left}px`;
            panel.style.width = `${inputRect.width}px`;
            panel.style.top = `${inputRect.bottom - wrapperRect.top + 6}px`;
            panel.style.right = 'auto';
        }

        input.addEventListener('input', function() {
            const query = input.value.trim();

            if (debounceTimer) {
                clearTimeout(debounceTimer);
            }

            debounceTimer = setTimeout(() => {
                if (query.length < 2) {
                    panel.style.display = 'none';
                    list.innerHTML = '';
                    return;
                }

                alignPanelToInput();

                fetch(`{{ route('facility.search') }}?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(items => {
                        list.innerHTML = '';
                        if (!Array.isArray(items) || items.length === 0) {
                            list.innerHTML = `<div class="notification-empty">Tidak ada hasil untuk "${query}"</div>`;
                            panel.style.display = 'block';
                            moreLink.href = `{{ route('facility') }}?search=${encodeURIComponent(query)}`;
                            return;
                        }

                        items.forEach(item => {
                            const link = document.createElement('a');
                            link.className = 'notification-item info';
                            link.href = `{{ url('/facility') }}/${item.id_fasilitas}`;
                            link.innerHTML = `
                                <div class="notification-dot"></div>
                                <div class="notification-content">
                                    <div class="notification-title-row">
                                        <span class="notification-subject" style="color: #333; font-weight: 600;">${item.nama_fasilitas}</span>
                                    </div>
                                    <div class="notification-message">${item.status_fasilitas || 'General'}</div>
                                </div>
                            `;
                            list.appendChild(link);
                        });

                        moreLink.href = `{{ route('facility') }}?search=${encodeURIComponent(query)}`;
                        panel.style.display = 'block';
                    })
                    .catch(() => {
                        panel.style.display = 'none';
                        list.innerHTML = '';
                    });
            }, 300);
        });

        document.addEventListener('click', function(event) {
            if (!wrapper.contains(event.target)) {
                panel.style.display = 'none';
            }
        });

        window.addEventListener('resize', function() {
            if (panel.style.display === 'block') {
                alignPanelToInput();
            }
        });
    })();
</script>