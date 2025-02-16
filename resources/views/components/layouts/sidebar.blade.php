<aside id="sidebar">
    <div class="sidebar__name">
        <h1>Administrator</h1>
        <button onclick=toggleHide()>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
        </button>
    </div>
    <nav class="sidebar__menu">
        <ul class="sidebar__list">
            <li class="sidebar__item"><a href="/"
                    class="{{ request()->is('/') ? 'sidebar__link active' : 'sidebar__link' }}">Dashboard</a></li>
            <li class="sidebar__item"><a href="{{ route('category_product.index') }}"
                    class="{{ request()->is('category_product') ? 'sidebar__link active' : 'sidebar__link' }}">Category
                    Product</a></li>
            <li class="sidebar__item"><a href="{{ route('product.index') }}"
                    class="{{ request()->is('product') ? 'sidebar__link active' : 'sidebar__link' }}">Produk</a></li>
            <li class="sidebar__item"><a href="{{ route('transaction.create') }}"
                    class="{{ request()->is('transaction/create') ? 'sidebar__link active' : 'sidebar__link' }}">Transaction</a>
            </li>

        </ul>
    </nav>
</aside>
