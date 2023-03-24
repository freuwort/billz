export function formatDate (date, format = 'long') {
    return new Date(date).toLocaleDateString('de-DE', {
        dateStyle: format,
    });
}