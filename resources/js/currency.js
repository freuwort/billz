export function formatPrice (price, currency = 'EUR') {
    return new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: currency,
    }).format(price);
}

export function formatPriceWithoutSymbol (price) {
    return new Intl.NumberFormat('de-DE', {
        style: 'decimal',
        minimumFractionDigits: 2,
    }).format(price);
}