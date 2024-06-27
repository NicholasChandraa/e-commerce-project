<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">
            <a href="{{ route('manageArticles') }}">Manajemen Artikel</a>
        </div>
        <div class="flex space-x-4 items-center">
            @if (Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('articlePages.create') }}"
                    class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6">Buat
                    Artikel</a>
                <a href="{{ route('article-categories.index') }}"
                    class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6">Artikel Kategori</a>
                <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>
            @endif
        </div>
    </div>
</nav>
