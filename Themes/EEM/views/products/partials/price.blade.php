<span class="price">
    @if (isset($price_sale) && $price_sale > 0 && $price_sale < $price && $is_promotion == 1)
        <ins>
            <span><span class="Price-currencySymbol">$ </span>{{ number_format($price_sale) }}</span>
        </ins>
        <del>$ {{ number_format($price) }}</del>
    @else
        <ins>
            <span><span class="Price-currencySymbol">$ </span>{{ number_format($price) }}</span>
        </ins>
    @endif
</span>
